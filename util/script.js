const zones = {
  'VIP': document.querySelectorAll('#VIP path'),
  'Lower Box': document.querySelectorAll('#Lower\\ Box path'),
  'Upper Box': document.querySelectorAll('#Upper\\ Box path'),
  'Gen Adm': document.querySelectorAll('#Gen\\ Adm path'),
};

const zoneColors = {
  'VIP': '#FF0066',
  'Lower Box': '#C0005A',
  'Upper Box': '#F4679D',
  'Gen Adm': '#F0B8CC',
};

const dimmedOpacity = '0.35';
let selectedPath = null;
let selectedZone = null;

const dimAll = () => {
  document.querySelectorAll('svg path').forEach(p => {
    if (p.getAttribute('fill') !== 'white' && p.getAttribute('fill') !== '#fff') {
      p.style.opacity = dimmedOpacity;
    }
  });
};

const restoreAll = () => {
  document.querySelectorAll('svg path').forEach(p => p.style.opacity = '1');
};

document.querySelectorAll('svg path').forEach(path => {
  if (path.getAttribute('fill') === 'white' || path.getAttribute('fill') === '#fff') return;

  path.addEventListener('click', () => {
    const isGenAdm = path.closest('#Gen\\ Adm');

    // --- GEN ADM: select entire zone ---
    if (isGenAdm) {
      if (selectedZone === 'Gen Adm') {
        // Deselect
        restoreAll();
        selectedZone = null;
        selectedPath = null;
        return;
      }

      // Clear previous individual selection
      if (selectedPath) {
        selectedPath.style.filter = '';
        selectedPath = null;
      }

      dimAll();
      zones['Gen Adm'].forEach(p => {
        if (p.getAttribute('fill') !== 'white') p.style.opacity = '1';
      });
      selectedZone = 'Gen Adm';
      return;
    }

    // --- OTHER ZONES: select individual section ---
    // Clear Gen Adm selection if switching
    if (selectedZone === 'Gen Adm') {
      selectedZone = null;
    }

    // Deselect if clicking same path
    if (selectedPath === path) {
      selectedPath.style.opacity = '1';
      selectedPath.style.filter = '';
      selectedPath = null;
      restoreAll();
      return;
    }

    // Deselect previous
    if (selectedPath) {
      selectedPath.style.opacity = '1';
      selectedPath.style.filter = '';
    }

    dimAll();
    path.style.opacity = '1';
    path.style.filter = 'brightness(1.4)';
    selectedPath = path;
  });
});