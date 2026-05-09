document.querySelectorAll('svg path').forEach(path => {
  path.addEventListener('click', () => {
    console.log(path.dataset.section); // "116", "201", "Gen Adm", etc.
  });
});