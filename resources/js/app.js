import './bootstrap';

// Lazy-load heavy viewers only when needed.
document.addEventListener('DOMContentLoaded', () => {
  if (window.__materialProgress?.kind === 'pdf') {
    import('./pdf-viewer.js');
  }

  if (window.__materialProgress?.kind === 'text') {
    import('./text-viewer.js');
  }
});
