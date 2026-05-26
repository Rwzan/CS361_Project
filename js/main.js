// client-side simple preview for the homepage
document.addEventListener('DOMContentLoaded', function () {
  const preview = document.getElementById('previewList');
  const q = document.getElementById('quickSearch');

  // fetch sample data from a small JSON endpoint (we'll simulate by calling php/search.php?preview=1)
  function loadPreview(term = '') {
    fetch('php/search.php?preview=1&q=' + encodeURIComponent(term))
      .then(r => r.text())
      .then(html => {
        preview.innerHTML = html;
      })
      .catch(e => {
        preview.innerHTML = '<p>Preview unavailable</p>';
      });
  }

  q.addEventListener('input', () => loadPreview(q.value));
  loadPreview();
});
