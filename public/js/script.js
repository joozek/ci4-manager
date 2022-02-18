const sortInputs = document.querySelectorAll('.arrow');
const search = document.querySelector('#search');

sortInputs.forEach(sortInput => {
  sortInput.addEventListener('click', (ev) => {
    ev.preventDefault();
    const input = sortInput.nextElementSibling;

    if (input.value === '') {
      input.value = 'ASC';
      sortInput.innerHTML = '<i class="fa fa-sort-down"></i>';
      search.submit();
      return;
    }

    if (input.value === 'ASC') {
      input.value = 'DESC';
      sortInput.innerHTML = '<i class="fa fa-sort-up"></i>';
      search.submit();
      return;
    }

    if (input.value === 'DESC') {
      input.value = '';
      sortInput.innerHTML = '<i class="fa fa-sort"></i>';
      search.submit();
      return;
    }
  });
});

