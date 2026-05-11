const HEARTBEAT_INTERVAL_MS = 5000;

function getCookie(name) {
  const prefix = `${name}=`;
  const parts = document.cookie.split(';');
  for (const part of parts) {
    const s = part.trim();
    if (s.startsWith(prefix)) return s.slice(prefix.length);
  }
  return null;
}

function getLaravelCsrfHeader() {
  // Laravel sets an XSRF-TOKEN cookie (URL-encoded). VerifyCsrfToken accepts X-XSRF-TOKEN.
  const raw = getCookie('XSRF-TOKEN');
  if (!raw) return {};
  try {
    return { 'X-XSRF-TOKEN': decodeURIComponent(raw) };
  } catch {
    return { 'X-XSRF-TOKEN': raw };
  }
}

export function initMaterialProgress({
  heartbeatUrl,
  isPdf,
  getPdfState,
  onCompleted,
  onProgress,
}) {
  const cfg = window.__materialProgress;
  if (!cfg || !heartbeatUrl) return;

  let isCompleted = Boolean(cfg.isCompleted);
  let activeSeconds = Number(cfg.initialActiveSeconds || 0);

  // We require explicit resume after any background/hidden event.
  let running = !isCompleted;
  let needsResume = false;

  const overlay = document.getElementById('material-paused-overlay');
  const resumeBtn = document.getElementById('material-resume-btn');

  const showOverlay = () => {
    if (overlay) overlay.classList.remove('hidden');
  };
  const hideOverlay = () => {
    if (overlay) overlay.classList.add('hidden');
  };

  const pause = () => {
    if (isCompleted) return;
    running = false;
    needsResume = true;
    showOverlay();
  };

  const resume = () => {
    if (isCompleted) return;
    if (document.visibilityState !== 'visible') return;
    running = true;
    needsResume = false;
    hideOverlay();
  };

  // Always start in "running" mode if visible. If not visible, require resume.
  if (document.visibilityState !== 'visible') {
    pause();
  }

  if (resumeBtn) {
    resumeBtn.addEventListener('click', resume);
  }

  document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'hidden') pause();
  });

  let lastHeartbeatAt = Date.now();
  let reachedLastPageOnce = Boolean(cfg.initialReachedLastPage);

  const sendHeartbeat = async () => {
    if (isCompleted) return;
    if (!running) return;
    if (document.visibilityState !== 'visible') return;
    if (needsResume) return;

    const now = Date.now();
    const deltaSeconds = Math.max(0, Math.min(7, Math.floor((now - lastHeartbeatAt) / 1000)));
    lastHeartbeatAt = now;

    const payload = {
      delta_seconds: deltaSeconds,
    };

    if (isPdf && typeof getPdfState === 'function') {
      const pdfState = getPdfState();
      if (pdfState?.totalPages) payload.pdf_total_pages = pdfState.totalPages;

      if (!reachedLastPageOnce && pdfState?.reachedLastPage) {
        payload.reached_last_page = true;
        reachedLastPageOnce = true;
      }
    }

    try {
      const res = await fetch(heartbeatUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          ...getLaravelCsrfHeader(),
        },
        credentials: 'same-origin',
        body: JSON.stringify(payload),
      });

      if (!res.ok) return;
      const data = await res.json();
      if (typeof data?.active_seconds === 'number') activeSeconds = data.active_seconds;
      if (data?.reached_last_page) reachedLastPageOnce = true;

      onProgress?.({
        active_seconds: activeSeconds,
        reached_last_page: reachedLastPageOnce,
        completed: Boolean(data?.completed),
      });

      if (data?.completed) {
        isCompleted = true;
        running = false;
        needsResume = false;
        hideOverlay();
        onCompleted?.(data);
      }
    } catch {
      // Network errors are non-fatal; next heartbeat will retry.
    }
  };

  // If we were started while hidden, overlay will be visible and user must press Resume.
  const interval = setInterval(sendHeartbeat, HEARTBEAT_INTERVAL_MS);

  // Also ping quickly after resume, to reduce perceived lag.
  const immediatePing = () => {
    lastHeartbeatAt = Date.now();
    setTimeout(sendHeartbeat, 250);
  };
  if (resumeBtn) {
    resumeBtn.addEventListener('click', immediatePing);
  }

  return {
    pause,
    resume,
    stop: () => clearInterval(interval),
  };
}
