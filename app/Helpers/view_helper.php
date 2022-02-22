<?php

/**
 * Return true if property value if property exists in object. False otherwise
 * 
 * @param object $object The object contains property
 * @param string $property Property's name that will be check
 * 
 * @return string
 */
function getIfPropertyExists(object $object, string $param): string
{
    return property_exists($object, $param) ? $object->{$param} : '';
}

/**
 * If the property exists in $form, checked property value and return sort icon
 * 
 * @param object $form Object with form properties
 * @param string $property Property's name that will be check
 * 
 * @return string
 */
function getSortIcon(object $form, string $property): string
{
    if (property_exists($form, $property) && $form->{$property} === 'DESC') {
        return '<i class="fa fa-sort-up"></i>';
    } elseif (property_exists($form, $property) && $form->{$property} === 'ASC') {
        return '<i class="fa fa-sort-down"></i>';
    } else {
        return '<i class="fa fa-sort"></i>';
    }
}

/**
 * Get the search form JavaScript that enable sorting
 * 
 * @return string
 */
function getSearchJS(): string {
    $js = '<script>';
    $js .= <<<'JS'
        const sortInputs = document.querySelectorAll('.arrow');
        const search = document.querySelector('#search');
        const arrow = {
            asc: '<i class="fa fa-sort-down"></i>',
            desc: '<i class="fa fa-sort-up"></i>',
            none: '<i class="fa fa-sort"></i>',
        }
        
        sortInputs.forEach(sortInput => {
            sortInput.addEventListener('click', (ev) => {
                ev.preventDefault();
                const input = sortInput.nextElementSibling;

                if (input.value === '') {
                    input.value = 'ASC';
                    sortInput.innerHTML = arrow.asc;
                    search.submit();
                    return;
                }
            
                if (input.value === 'ASC') {
                    input.value = 'DESC';
                    sortInput.innerHTML = arrow.desc;
                    search.submit();
                    return;
                }
            
                if (input.value === 'DESC') {
                    input.value = '';
                    sortInput.innerHTML = arrow.none;
                    search.submit();
                    return;
                }
            });
        });

        const searchBtn = document.querySelector('.search__button');

        searchBtn.addEventListener('click', (ev) => {
            ev.preventDefault();
            search.action = '/';
            search.submit();
        });
    JS;
    $js .= '</script>';
    return $js;
}