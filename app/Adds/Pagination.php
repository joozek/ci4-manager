<?php

namespace App\Adds;

use Config\Services;

use App\Adds\Pagination\Methods;

class Pagination extends Methods
{

  public function __construct(array $options)
  {
    // Initialize basic parameters
    $this->setAction($options['action']);
    $this->setPerPage($options['perPage']);
    $this->setTotalRows($options['totalRows']);
    $this->setPagesCount($this->getTotalRows(), $this->getPerPage());
    $this->setPerPageArray($options['perPageArray']);

    // Initialize request
    $this->request = Services::request();
  }

  private function generateJS(string $formID, string $inputsClass): string {
    return "
      <script>
        const {$inputsClass} = document.querySelectorAll('.{$inputsClass}');
        const {$formID} = document.querySelector('#{$formID}');
        window.pagination = document.querySelector('#pagination');

        {$inputsClass}.forEach((input) => {
          input.addEventListener('click', (ev) => {
            ev.preventDefault();
            {$formID}.setAttribute('value', ev.target.value);
            window.pagination.submit();
          });
      });
      </script>
    ";
  }

  private function createPerPageLinks(array $perPageArray) : string
  {
    $perPageLinks = '<div class="'.$this->getLimitContainerClass().'">';

    $perPageLinks .= '<input id="'.$this->getLimitContainerClass().'" type="hidden" name="'.$this->getLimitField().'" value="'.$this->getPerPage().'" />';
    foreach($perPageArray as $perPage) {
      $class = $perPage === $this->getPerPage() ? ($this->getLimitActiveClass(). ' ' .$this->getLimitItemClass()) : $this->getLimitItemClass();
      $perPageLinks .= '<input type="submit" class="'.$this->getLimitField() .' '.$class.'" value="'.$perPage.'" />';
    }

    $perPageLinks .= '</div>';
    
    return $perPageLinks;
  }

  public function getOffset(int $page): int
  {
    return ($page - 1) * $this->getPerPage();
  }

  private function hasPrev(int $page, int $offset = 1): bool
  {
    if (!is_int($page) || ($page - $offset) <= 0) {
      return FALSE;
    }
    return TRUE;
  }

  private function hasNext(int $page, int $offset = 1): bool
  {
    if (!is_int($page) || ($page + $offset) > $this->getPagesCount()) {
      return FALSE;
    }

    return TRUE;
  }

  private function createLinks(int $page): string
  {
    $output = '<div class="' . $this->getContainerClass() . '">';

    if ($page === $this->getPagesCount() && $this->hasPrev($page, 2)) {
      $output .= '<input type="submit" value="' . ($page - 2) . '" class="'. $this->getPageField() . ' ' . $this->getItemClass() . '">';
    }

    if ($this->hasPrev($page)) {
      $output .= '<input type="submit" value="' . ($page - 1) . '" class="'. $this->getPageField() . ' ' . $this->getItemClass() . '">';
    }

    $output .= '<input type="submit" value="' . $page . '" class="'. $this->getPageField() . ' ' . $this->getItemClass() . ' ' . $this->getActiveClass(). '">';

    if ($this->hasNext($page)) {
      $output .= '<input type="submit" value="' . ($page + 1) . '" class="'. $this->getPageField() . ' ' . $this->getItemClass() . '">';
    }

    if ($page === 1 && $this->hasNext($page, 2)) {
      $output .= '<input type="submit" value="' . ($page + 2) . '" class="'. $this->getPageField() . ' ' . $this->getItemClass() . '">';
    }

    $output .= '</div>';

    return $output;
  }

  private function createHiddenPostFields(string $exclude = null): string
  {
    $fields = $this->request->getPost();

    $output = '';

    foreach ($fields as $key => $field) {
      if($key === $exclude) continue;
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
    $output = '<form id="'.$this->getContainerClass().'" method="' . $this->getMethod() . '" action="' . $this->getAction() . $this->createGetFields() . '">';
    $output .= $this->createHiddenPostFields($this->getPageField());
    $output .= '<input id="' . $this->getPageForm() .'" type="hidden" name="' . $this->getPageField() . '" value="'.$this->getPage().'">';
    $output .= $this->createLinks($page);
    $output .= $this->generateJS($this->getPageForm(), $this->getPageField());
    $output .= $this->createPerPageLinks($this->getPerPageArray());
    $output .= $this->generateJS($this->getLimitForm(), $this->getLimitField());
    $output .= '</form>';

    return $output;
  }
}
