
      // Table sorting
let lastSortedColumn = -1;
let lastSortDirection = '';

function sortTable(columnIndex, dataType) {
  const table = document.querySelector('table');
  const rows = Array.from(table.tBodies[0].rows);

  const header = document.querySelector(`th:nth-child(${columnIndex + 1})`);
  const icon = header.querySelector('.sort-icon');

  let sortDirection;

  if (lastSortedColumn === columnIndex) {
      sortDirection = lastSortDirection === 'asc' ? 'desc' : 'asc';
  } else {
      sortDirection = 'asc';
  }

  rows.sort((a, b) => {
      const aValue = a.cells[columnIndex].innerText.trim();
      const bValue = b.cells[columnIndex].innerText.trim();

      if (dataType === 'number') {
          return (parseFloat(aValue) - parseFloat(bValue)) * (sortDirection === 'asc' ? 1 : -1);
      } else {
          return aValue.localeCompare(bValue) * (sortDirection === 'asc' ? 1 : -1);
      }
  });

  if (lastSortedColumn !== -1 && lastSortedColumn !== columnIndex) {
      const lastHeader = document.querySelector(`th:nth-child(${lastSortedColumn + 1})`);
      const lastIcon = lastHeader.querySelector('.sort-icon');
      lastIcon.classList.remove('fa-sort-up', 'fa-sort-down');
      lastIcon.classList.add('fa-sort');
  }

  if (sortDirection === 'asc') {
      icon.classList.remove('fa-sort', 'fa-sort-down');
      icon.classList.add('fa-sort-up');
  } else {
      icon.classList.remove('fa-sort', 'fa-sort-up');
      icon.classList.add('fa-sort-down');
  }

  lastSortedColumn = columnIndex;
  lastSortDirection = sortDirection;

  // Remove existing rows from the tbody
  while (table.tBodies[0].firstChild) {
      table.tBodies[0].removeChild(table.tBodies[0].firstChild);
  }

  // Append sorted rows to the tbody
  rows.forEach(row => table.tBodies[0].appendChild(row));
}

document.addEventListener('DOMContentLoaded', () => {
  // ... previous JavaScript code ...

  // Table sorting event listeners
  document.querySelectorAll('th').forEach((header, index) => {
      header.addEventListener('click', () => {
          const dataType = header.getAttribute('data-type');
          
          sortTable(index, dataType);
          console.log(index);
      });
  });
});

