<?php

/**
 * Return true if property value if property exists in object. False otherwise
 * 
 * @param object $object The object contains property
 * @param string $property Property's name that will be check
 * 
 * @return bool
 */
function getIfPropertyExists(object $object, string $param): bool
{
    return property_exists($object, $param) ? $object->{$param} : false;
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
    return <<<'JS'
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
    JS;
}