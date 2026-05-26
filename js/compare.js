// compare.js: handles Compare checkboxes on search page
function toggleCompareCheckbox(cb) {
  const checked = document.querySelectorAll('.compare-cb:checked');

  if (checked.length > 3) {
    cb.checked = false;
    alert('You can compare up to 3 tutors only.');
    return;
  }
}

function doCompare() {
  const checked = Array.from(document.querySelectorAll('.compare-cb:checked'));

  if (checked.length < 2) {
    alert('Select 2 or 3 tutors to compare.');
    return;
  }

  // Build comparison modal content
  const tutors = checked.map(cb => {
    const id = cb.dataset.id;

    return {
      id: id,
      name: document.getElementById('tname-' + id).innerText,
      subject: document.getElementById('tsub-' + id).innerText,
      rate: document.getElementById('trate-' + id).innerText,
      bio: document.getElementById('tbio-' + id).innerText,
      video: document.getElementById('tvideo-' + id).dataset.src
    };
  });

  // simple popup window with side-by-side info
  let html = '<div style="display:flex;gap:8px;">';

  tutors.forEach(t => {
    html += '<div style="flex:1;border:1px solid #ccc;padding:8px;border-radius:6px;background:#fff;">';
    html += '<h3>' + t.name + '</h3>';
    html += '<p><strong>Subjects:</strong> ' + t.subject + '</p>';
    html += '<p><strong>Rate:</strong> ' + t.rate + '</p>';
    html += '<p>' + t.bio + '</p>';

    if (t.video) {
      html += '<video width="100%" controls src="' + t.video + '"></video>';
    }

    html += '</div>';
  });

  html += '</div>';

  const win = window.open('', 'compare', 'width=900,height=600');
  win.document.write(
    '<html><head><title>Compare Tutors</title></head><body>' +
      html +
    '</body></html>'
  );
}
