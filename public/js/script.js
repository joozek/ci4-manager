const arrows = document.querySelectorAll('.arrow');
const search = document.querySelector('#search');

arrows.forEach((arrow) => {
    arrow.addEventListener('click', (ev) => {
        ev.preventDefault();
        const input = arrow.nextElementSibling;

        if (input.value === '') {
            input.value = 'ASC';
            arrow.innerHTML = '<i class="fa fa-arrow-down"></i>';
            search.submit();
            return;
        }

        if (input.value === 'ASC') {
            input.value = 'DESC';
            arrow.innerHTML = '<i class="fa fa-arrow-up"></i>';
            search.submit();
            return;
        }

        if (input.value === 'DESC') {
            input.value = '';
            arrow.innerHTML = '<i class="fa fa-arrow-down"></i><i class="fa fa-arrow-up"></i>';
            search.submit();
            return;
        }
    });
})

const links = document.querySelectorAll('.link');
const page = document.querySelector('#page');

links.forEach((link) => {
    link.addEventListener('click', (ev) => {
        ev.preventDefault();
        page.setAttribute('value', ev.target.value);

        link.parentElement.submit();
    });
});
