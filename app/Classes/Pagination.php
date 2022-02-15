<?php

namespace App\Classes;

use Config\Services;

class Pagination
{
  private $perPage;
  private $pagesCount;
  private $totalRows;
  private $maxPerPage = 100;
  private $action;
  private $activeClass = 'pagination__item--active';
  private $itemClass = 'pagination__item';
  private $containerClass = 'pagination';
  private $pageField = 'page';
  private $method = 'POST';

  public function initialize(string $action, int $perPage, int $totalRows)
  {
    $max = $this->maxPerPage;

    // Initialize basic parameters
    $this->action = $action;
    $this->perPage = $perPage > $max ? $max : $perPage;
    $this->totalRows = $totalRows;
    $this->pagesCount = (int) ceil($totalRows / $perPage);

    // Initialize request
    $this->request = Services::request();
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

  private function hasPrev($page): bool
  {
    if (!is_int($page) || --$page <= 0) {
      return FALSE;
    }
    return TRUE;
  }

  private function hasNext($page): bool
  {
    if (!is_int($page) || ++$page > $this->pagesCount) {
      return FALSE;
    }

    return TRUE;
  }

  private function createLinks($page)
  {
    $output = '';
    $itemClass = $this->itemClass;
    $activeItemClass = $itemClass . ' ' . $this->activeClass;

    if ($this->hasPrev($page)) {
      $output .= '<input type="submit" value="' . ($page - 1) . '" class="link ' . $itemClass . '">';
    }

    $output .= '<input type="submit" value="' . $page . '" class="link ' . $activeItemClass . '">';

    if ($this->hasNext($page)) {
      $output .= '<input type="submit" value="' . ($page + 1) . '" class="link ' . $itemClass . '">';
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
    $action = $this->action . $this->createGetFields();

    $output = '<form method="' . $this->method . '" action="' . $action . '" class="' . $this->containerClass . '">';
    $output .= $this->createHiddenPostFields();
    $output .= '<input id="' . $this->pageField . '" type="hidden" name="' . $this->pageField . '" value="">';
    $output .= $this->createLinks($page);
    $output .= '</form>';

    return $output;
  }
}
