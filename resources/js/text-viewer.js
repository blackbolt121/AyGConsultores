import { initMaterialProgress } from './material-progress.js';

function setCompletedBadge() {
  const badge = document.getElementById('material-status-badge');
  if (!badge) return;
  badge.className =
    'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset bg-emerald-50 text-emerald-700 ring-emerald-700/10';
  badge.innerHTML =
    '<svg class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 0 1 .006 1.414l-7.5 7.57a1 1 0 0 1-1.42.003L3.296 9.7a1 1 0 1 1 1.408-1.418l3.09 3.065 6.79-6.857a1 1 0 0 1 1.42-.001Z" clip-rule="evenodd"/></svg>Completado';
}

const cfg = window.__materialProgress;
if (cfg?.kind === 'text') {
  const timeChip = document.getElementById('text-time-chip');
  const updateTimeChip = (activeSeconds) => {
    if (!timeChip) return;
    const a = Math.max(0, Math.min(30, Number(activeSeconds || 0)));
    timeChip.textContent = `Tiempo activo: ${a}/30s`;
  };

  updateTimeChip(cfg.initialActiveSeconds);

  initMaterialProgress({
    heartbeatUrl: cfg.heartbeatUrl,
    isPdf: false,
    onCompleted: setCompletedBadge,
    onProgress: (p) => updateTimeChip(p.active_seconds),
  });
}
