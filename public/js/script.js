const arrows = document.querySelectorAll('.arrow');
const search = document.querySelector('#search');

arrows.forEach((arrow) => {
    arrow.addEventListener('click', (ev) => {
        ev.preventDefault();
        const input = arrow.nextElementSibling;

        const limitValue = document.querySelector('#limit').value;

        const limit = document.createElement('input');
        limit.setAttribute('type', 'hidden');
        limit.setAttribute('name', 'limit');
        limit.setAttribute('value', limitValue);
        search.prepend(limit);

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

const limitLinks = document.querySelectorAll('.limit');
const limit = document.querySelector('#limit');

limitLinks.forEach((limitLink) => {
    limitLink.addEventListener('click', (ev) => {
        ev.preventDefault();
        limit.setAttribute('value', ev.target.value);

        limitLink.parentElement.submit();
    })
})