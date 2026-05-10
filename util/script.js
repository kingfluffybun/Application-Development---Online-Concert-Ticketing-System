const seatContainer = document.querySelector('.seat');

const zones = {
  'VIP': seatContainer.querySelectorAll('#VIP path'),
  'Lower Box': seatContainer.querySelectorAll('#Lower\\ Box path'),
  'Upper Box': seatContainer.querySelectorAll('#Upper\\ Box path'),
  'Gen Adm': seatContainer.querySelectorAll('#Gen\\ Adm path'),
};

const zoneCSSVars = {
  'VIP': '--vip',
  'Lower Box': '--lower-box',
  'Upper Box': '--upper-box',
  'Gen Adm': '--gen-ad',
};

const zonePrices = {
  'VIP': 8500,
  'Lower Box': 5500,
  'Upper Box': 3500,
  'Gen Adm': 1500,
};

const dimmedOpacity = '0.5';
let selectedPath = null;
let selectedZone = null;
let selectedSection = null;
let quantity = 1;

// DOM Elements
const quantityInput = document.getElementById('ticket-quantity');
const minusBtn = document.getElementById('decrease-btn');
const plusBtn = document.getElementById('increase-btn');
const selectedZoneDisplay = document.getElementById('selected-zone');
const selectedSectionDisplay = document.getElementById('selected-section');
const priceDisplay = document.getElementById('price');
const quantityDisplay = document.getElementById('quantity');
const totalPriceDisplay = document.getElementById('total-price');
const zonePillElement = document.getElementById('zone-pill');
const ticketFormSection = document.querySelector('.ticket-form');
const paymentSection = document.querySelector('.payment-form');

// Update summary display
const updateSummary = () => {
  if (selectedZone && selectedSection) {
    const basePrice = zonePrices[selectedZone];
    const totalPrice = basePrice * quantity;
    const cssVar = zoneCSSVars[selectedZone];
    const colorValue = getComputedStyle(document.documentElement).getPropertyValue(cssVar).trim();
    
    selectedZoneDisplay.textContent = selectedZone;
    selectedSectionDisplay.textContent = selectedSection;
    priceDisplay.textContent = `₱${basePrice.toLocaleString()}`;
    quantityDisplay.textContent = quantity;
    totalPriceDisplay.textContent = `₱${totalPrice.toLocaleString()}`;
    zonePillElement.style.backgroundColor = colorValue;
    zonePillElement.style.display = 'block';
  } else {
    selectedZoneDisplay.textContent = '';
    selectedSectionDisplay.textContent = '';
    priceDisplay.textContent = '';
    quantityDisplay.textContent = '';
    totalPriceDisplay.textContent = '';
    zonePillElement.style.display = 'none';
  }
};

// Quantity controls
const updateQuantity = (value) => {
  if (value >= 1 && value <= 5) {
    quantity = value;
    quantityInput.value = quantity;
    updateSummary();
  }
};

quantityInput.addEventListener('change', (e) => {
  updateQuantity(parseInt(e.target.value) || 1);
});

minusBtn.addEventListener('click', () => {
  updateQuantity(quantity - 1);
});

plusBtn.addEventListener('click', () => {
  updateQuantity(quantity + 1);
});

// Zoom helper function
const getZoneFromPath = (path) => {
  for (const [zone, paths] of Object.entries(zones)) {
    if (Array.from(paths).includes(path)) {
      return zone;
    }
  }
  return null;
};

// Extract section number from path ID
const getSectionFromPath = (path) => {
  const id = path.id;
  const groupId = path.closest('g')?.id;
  return groupId || id || 'Unknown';
};

const dimAll = () => {
  seatContainer.querySelectorAll('svg path').forEach(p => {
    if (p.getAttribute('fill') !== 'white' && p.getAttribute('fill') !== '#fff') {
      p.style.opacity = dimmedOpacity;
    }
  });
};

const restoreAll = () => {
  seatContainer.querySelectorAll('svg path').forEach(p => p.style.opacity = '1');
};

seatContainer.querySelectorAll('svg path').forEach(path => {
  if (path.getAttribute('fill') === 'white' || path.getAttribute('fill') === '#fff') return;

  path.style.cursor = 'pointer';

  path.addEventListener('click', () => {
    const zone = getZoneFromPath(path);
    const isGenAdm = path.closest('#Gen\\ Adm');

    if (isGenAdm && zone === 'Gen Adm') {
      if (selectedZone === 'Gen Adm') {
        restoreAll();
        selectedZone = null;
        selectedPath = null;
        selectedSection = null;
        quantityDisplay.textContent = '1';
        updateSummary();
        return;
      }

      if (selectedPath) {
        selectedPath.style.filter = '';
        selectedPath = null;
      }

      dimAll();
      zones['Gen Adm'].forEach(p => {
        if (p.getAttribute('fill') !== 'white') p.style.opacity = '1';
      });
      selectedZone = 'Gen Adm';
      selectedSection = getSectionFromPath(path);
      updateSummary();
      return;
    }

    if (selectedZone === 'Gen Adm') {
      selectedZone = null;
    }

    if (selectedPath === path) {
      selectedPath.style.opacity = '1';
      selectedPath.style.filter = '';
      selectedPath = null;
      selectedZone = null;
      selectedSection = null;
      restoreAll();
      updateSummary();
      return;
    }

    if (selectedPath) {
      selectedPath.style.opacity = '1';
      selectedPath.style.filter = '';
    }

    dimAll();
    path.style.opacity = '1';
    path.style.filter = 'brightness(1.4)';
    selectedPath = path;
    selectedZone = zone;
    selectedSection = getSectionFromPath(path);
    updateSummary();
  });
});

const proceedButton = document.getElementById('proceed-btn');

const showSection = (showSectionElement, hideSectionElement) => {
  showSectionElement.style.display = 'flex';
  hideSectionElement.style.display = 'none';
};

proceedButton.addEventListener('click', () => {
  if (!selectedZone || !selectedSection) {
    return;
  }

  showSection(paymentSection, ticketFormSection);
});