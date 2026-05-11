import * as pdfjsLib from 'pdfjs-dist/build/pdf';
import pdfjsWorker from 'pdfjs-dist/build/pdf.worker?url';
import { initMaterialProgress } from './material-progress.js';

pdfjsLib.GlobalWorkerOptions.workerSrc = pdfjsWorker;

function cls(el, on, className) {
  if (!el) return;
  if (on) el.classList.add(className);
  else el.classList.remove(className);
}

function setModeButtons(mode) {
  document.querySelectorAll('[data-pdf-mode]').forEach((btn) => {
    const m = btn.getAttribute('data-pdf-mode');
    const active = m === mode;
    btn.className =
      'px-3 py-1.5 rounded-lg text-xs font-medium ' +
      (active
        ? 'bg-slate-900 text-white'
        : 'text-slate-700 hover:bg-slate-100');
  });
}

function setCompletedBadge() {
  const badge = document.getElementById('material-status-badge');
  if (!badge) return;
  badge.className =
    'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset bg-emerald-50 text-emerald-700 ring-emerald-700/10';
  badge.innerHTML =
    '<svg class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 0 1 .006 1.414l-7.5 7.57a1 1 0 0 1-1.42.003L3.296 9.7a1 1 0 1 1 1.408-1.418l3.09 3.065 6.79-6.857a1 1 0 0 1 1.42-.001Z" clip-rule="evenodd"/></svg>Completado';
}

function getVisiblePageInScroll(container, pageEls) {
  const rect = container.getBoundingClientRect();
  let best = null;
  let bestRatio = 0;

  for (const el of pageEls) {
    const r = el.getBoundingClientRect();
    const top = Math.max(r.top, rect.top);
    const bottom = Math.min(r.bottom, rect.bottom);
    const visible = Math.max(0, bottom - top);
    const ratio = visible / Math.max(1, r.height);
    if (ratio > bestRatio) {
      bestRatio = ratio;
      best = el;
    }
  }

  return best ? Number(best.dataset.pageNumber) : 1;
}

async function initPdfViewer() {
  const cfg = window.__materialProgress;
  if (!cfg || cfg.kind !== 'pdf') return;

  const root = document.getElementById('pdf-viewer');
  const container = document.getElementById('pdf-container');
  const indicator = document.getElementById('pdf-page-indicator');
  const indicatorTop = document.getElementById('pdf-page-indicator-top');
  const timeChip = document.getElementById('pdf-time-chip');
  const lastPageChip = document.getElementById('pdf-last-page-chip');
  if (!root || !container) return;

  const pdfUrl = root.getAttribute('data-pdf-url');
  if (!pdfUrl) return;

  let mode = localStorage.getItem('pdfViewerMode') || 'scroll';
  if (mode !== 'scroll' && mode !== 'paged') mode = 'scroll';
  setModeButtons(mode);

  const loadingTask = pdfjsLib.getDocument({ url: pdfUrl, withCredentials: true });
  const pdf = await loadingTask.promise;
  const totalPages = pdf.numPages;

  let reachedLastPage = Boolean(cfg.initialReachedLastPage);
  let currentPage = 1;

  const pageEls = [];

  const updateIndicator = () => {
    if (indicator) indicator.textContent = `${currentPage} / ${totalPages}`;
    if (indicatorTop) indicatorTop.textContent = `Pagina ${currentPage} de ${totalPages}`;
  };

  const setReachedIfLast = (pageNumber) => {
    if (!reachedLastPage && pageNumber === totalPages) {
      reachedLastPage = true;
    }
  };

  const updateLastPageChip = () => {
    if (!lastPageChip) return;
    if (reachedLastPage) {
      lastPageChip.className = 'inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-700/10';
      lastPageChip.textContent = 'Ultima pagina vista';
    } else {
      lastPageChip.className = 'inline-flex items-center rounded-full bg-slate-50 px-3 py-1 text-xs font-medium text-slate-700 ring-1 ring-inset ring-slate-700/10';
      lastPageChip.textContent = 'Falta ultima pagina';
    }
  };

  const updateTimeChip = (activeSeconds) => {
    if (!timeChip) return;
    const a = Math.max(0, Math.min(30, Number(activeSeconds || 0)));
    timeChip.textContent = `Tiempo activo: ${a}/30s`;
  };

  // Rendering helpers
  const renderPageToCanvas = async (pageNumber, canvas) => {
    const page = await pdf.getPage(pageNumber);
    const viewport = page.getViewport({ scale: 1.25 });
    const ctx = canvas.getContext('2d');
    canvas.width = Math.floor(viewport.width);
    canvas.height = Math.floor(viewport.height);
    await page.render({ canvasContext: ctx, viewport }).promise;
  };

  const clearContainer = () => {
    container.innerHTML = '';
    pageEls.length = 0;
  };

  const renderPaged = async (pageNumber) => {
    clearContainer();
    const wrap = document.createElement('div');
    wrap.className = 'h-full w-full flex flex-col';

    const nav = document.createElement('div');
    nav.className = 'flex items-center justify-between gap-3 px-4 py-3 border-b border-slate-100 bg-slate-50';
    nav.innerHTML = `
      <button type="button" data-pdf-prev class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50">Anterior</button>
      <div class="text-xs text-slate-600" data-pdf-indicator></div>
      <button type="button" data-pdf-next class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50">Siguiente</button>
    `;

    const viewport = document.createElement('div');
    viewport.className = 'flex-1 overflow-auto';

    const canvasWrap = document.createElement('div');
    canvasWrap.className = 'p-4 flex justify-center';
    const canvas = document.createElement('canvas');
    canvas.className = 'max-w-full h-auto rounded-xl border border-slate-200 shadow-sm';
    canvasWrap.appendChild(canvas);
    viewport.appendChild(canvasWrap);

    wrap.appendChild(nav);
    wrap.appendChild(viewport);
    container.appendChild(wrap);

    currentPage = pageNumber;
    updateIndicator();
    nav.querySelector('[data-pdf-indicator]').textContent = `${currentPage} / ${totalPages}`;

    await renderPageToCanvas(currentPage, canvas);
    setReachedIfLast(currentPage);

    const prevBtn = nav.querySelector('[data-pdf-prev]');
    const nextBtn = nav.querySelector('[data-pdf-next]');
    prevBtn.disabled = currentPage <= 1;
    nextBtn.disabled = currentPage >= totalPages;
    cls(prevBtn, prevBtn.disabled, 'opacity-50');
    cls(nextBtn, nextBtn.disabled, 'opacity-50');

    prevBtn.addEventListener('click', async () => {
      if (currentPage <= 1) return;
      await renderPaged(currentPage - 1);
    });
    nextBtn.addEventListener('click', async () => {
      if (currentPage >= totalPages) return;
      await renderPaged(currentPage + 1);
    });
  };

  const renderScroll = async () => {
    clearContainer();
    const list = document.createElement('div');
    list.className = 'space-y-6 p-4';

    for (let i = 1; i <= totalPages; i++) {
      const pageWrap = document.createElement('div');
      pageWrap.className = 'flex justify-center';
      pageWrap.dataset.pageNumber = String(i);

      const canvas = document.createElement('canvas');
      canvas.className = 'max-w-full h-auto rounded-xl border border-slate-200 shadow-sm bg-white';
      pageWrap.appendChild(canvas);
      list.appendChild(pageWrap);
      pageEls.push(pageWrap);

      // Render sequentially to keep it simple. (We can optimize later.)
      // eslint-disable-next-line no-await-in-loop
      await renderPageToCanvas(i, canvas);
    }

    container.appendChild(list);

    const onScroll = () => {
      currentPage = getVisiblePageInScroll(container, pageEls);
      updateIndicator();
      setReachedIfLast(currentPage);
    };

    container.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  };

  const setMode = async (nextMode) => {
    if (nextMode !== 'scroll' && nextMode !== 'paged') return;
    mode = nextMode;
    localStorage.setItem('pdfViewerMode', mode);
    setModeButtons(mode);
    if (mode === 'paged') await renderPaged(1);
    else await renderScroll();
  };

  document.querySelectorAll('[data-pdf-mode]').forEach((btn) => {
    btn.addEventListener('click', () => setMode(btn.getAttribute('data-pdf-mode')));
  });

  await setMode(mode);
  updateIndicator();
  updateLastPageChip();
  updateTimeChip(cfg.initialActiveSeconds);

  initMaterialProgress({
    heartbeatUrl: cfg.heartbeatUrl,
    isPdf: true,
    getPdfState: () => ({ totalPages, reachedLastPage }),
    onCompleted: () => setCompletedBadge(),
    onProgress: (p) => {
      updateTimeChip(p.active_seconds);
      updateLastPageChip();
    },
  });
}

initPdfViewer();
