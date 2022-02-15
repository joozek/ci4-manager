<?php

namespace App\Classes;

use Config\Services;
class Pagination
{
  private $perPage = 5;
  private $maxLimit = 50;
  private $pagesCount = 0;
  private $totalRows = 0;

  private $action = '';
  private $method = 'POST';
  private $pageField = 'page';
  private $limitField = 'limit';

  private $pageJS = "
  <script>
    const links = document.querySelectorAll('.link');
    const page = document.querySelector('#page');
  
    links.forEach((link) => {
      link.addEventListener('click', (ev) => {
        ev.preventDefault();
        page.setAttribute('value', ev.target.value);
        link.parentElement.submit();
      });
  });
  </script>";

  private $limitJS = "
  <script>
    const limitLinks = document.querySelectorAll('.limit');
    const limit = document.querySelector('#limit');

    limitLinks.forEach((limitLink) => {
        limitLink.addEventListener('click', (ev) => {
            ev.preventDefault();
            limit.setAttribute('value', ev.target.value);

            limitLink.parentElement.submit();
        });
    });
  </script>";

  private $containerClass = 'pagination';
  private $itemClass = 'pagination__item';
  private $activeClass = 'pagination__item--active';
  

  private $limitContainerClass = 'limitLinks';
  private $limitItemClass = 'limitLinks__item';
  private $limitActiveClass = 'limitLinks__item--active';

  public function initialize(string $action, int $perPage, int $totalRows)
  {
    $max = $this->maxLimit;

    // Initialize basic parameters
    $this->action = $action;
    $this->perPage = $perPage > $max ? $max : $perPage;
    $this->totalRows = $totalRows;
    $this->pagesCount = (int) ceil($totalRows / $perPage);

    // Initialize request
    $this->request = Services::request();
  }

  public function setMaxLimit(int $newLimit) {
    if($newLimit > 500) {
      trigger_error('Max Limit is greater than 500. The browser can trouble.', E_USER_WARNING);
    }

    $maxLimit = $newLimit;
  }

  public function getMaxLimit() {
    return $this->maxLimit;
  }

  private function createPerPageLinks(array $perPageArray) {
    $action = $this->action . $this->createGetFields();

    $perPageLinks = '<form class="'.$this->limitContainerClass.'" method="POST" action="'.$action.'">';

    $perPageLinks .= $this->createHiddenPostFields();
    $perPageLinks .= '<input id="limit" type="hidden" name="'.$this->limitField.'" value="'.$this->perPage.'" />';
    foreach($perPageArray as $perPage) {
      $activeClass = $this->limitItemClass . ' ' . $this->limitActiveClass;
      $itemClass = $this->limitItemClass;
      $class = ($perPage ===   $this->perPage) ? $activeClass : $itemClass;
      $perPageLinks .= '<input type="submit" class="limit '.$class.'" value="'.$perPage.'" />';
    }

    $perPageLinks .= $this->limitJS;

    $perPageLinks .= '</form>';
    
    return $perPageLinks;
  }

  public function getPerPageLinks(array $array) {
    return $this->createPerPageLinks($array);
  }

  public function getPagesCount()
  {
    return $this->pagesCount;
  }

  public function getOffset($page)
  {
    $offset = ($page - 1 > 0 ? $page - 1 : 0) * $this->perPage;

    if ($offset > $this->totalRows) {
      $offset = ($this->pagesCount - 1) * $this->perPage;
    }

    return $offset;
  }

  private function hasPrev($page, $offset = 1): bool
  {
    if (!is_int($page) || ($page - $offset) <= 0) {
      return FALSE;
    }
    return TRUE;
  }

  private function hasNext($page, $offset = 1): bool
  {
    if (!is_int($page) || ($page + $offset) > $this->pagesCount) {
      return FALSE;
    }

    return TRUE;
  }

  private function createLinks($page)
  {
    $output = '';
    $itemClass = $this->itemClass;
    $activeItemClass = $itemClass . ' ' . $this->activeClass;

    if ($page === $this->pagesCount && $this->hasPrev($page, 2)) {
      $output .= '<input type="submit" value="' . ($page - 2) . '" class="link ' . $itemClass . '">';
    }

    if ($this->hasPrev($page)) {
      $output .= '<input type="submit" value="' . ($page - 1) . '" class="link ' . $itemClass . '">';
    }

    $output .= '<input type="submit" value="' . $page . '" class="link ' . $activeItemClass . '">';

    if ($this->hasNext($page)) {
      $output .= '<input type="submit" value="' . ($page + 1) . '" class="link ' . $itemClass . '">';
    }

    if ($page === 1 && $this->hasNext($page, 2)) {
      $output .= '<input type="submit" value="' . ($page + 2) . '" class="link ' . $itemClass . '">';
    }

    return $output;
  }

  private function createHiddenPostFields()
  {
    $fields = $this->request->getPost();

    $output = '';

    foreach ($fields as $key => $field) {
      $output .= '<input type="hidden" name="' . $key . '" value="' . $field . '" />';
    }

    return $output;
  }


  private function createGetFields()
  {
    $fields = $this->request->getGet();
    $fieldsCount = count($fields);
    if ($fieldsCount === 0) {
      return;
    }

    $getString = '?';

    $i = 1;
    foreach ($fields as $key => $field) {
      if ($i === $fieldsCount) {
        $getString .= $key . '=' . $field;
        continue;
      }
      $getString .= $key . '=' . $field . '&';
      $i++;
    }

    return $getString;
  }

  public function getPagination(int $page)
  {
    if($this->pagesCount === 1) {
      return;
    }
    $action = $this->action . $this->createGetFields();

    $output = '<form method="' . $this->method . '" action="' . $action . '" class="' . $this->containerClass . '">';
    $output .= $this->createHiddenPostFields();
    $output .= '<input id="' . $this->pageField . '" type="hidden" name="' . $this->pageField . '" value="">';
    $output .= $this->createLinks($page);
    $output .= $this->pageJS;
    $output .= '</form>';

    return $output;
  }
}
