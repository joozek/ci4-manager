const arrows = document.querySelectorAll('.arrow');
const search = document.querySelector('#search');

arrows.forEach((arrow) => {
    arrow.addEventListener('click', (ev) => {
        ev.preventDefault();
        const input = arrow.nextElementSibling;

        if (input.value === '') {
            input.value = 'ASC';
            arrow.innerHTML = '<i class="fa fa-sort-down"></i>';
            search.submit();
            return;
        }

        if (input.value === 'ASC') {
            input.value = 'DESC';
            arrow.innerHTML = '<i class="fa fa-sort-up"></i>';
            search.submit();
            return;
        }

        if (input.value === 'DESC') {
            input.value = '';
            arrow.innerHTML = '<i class="fa fa-sort"></i>';
            search.submit();
            return;
        }
    });
});

