<?php

namespace App\Adds\Pagination;

class Methods {
  private $page = 1;
  private $perPage = 10;
  private $perPageArray = [];
  private $pagesCount = 1;
  
  private $totalRows = 0;
  private $maxLimit = 100;

  private $action = '';
  private $method = 'POST';
  
  private $pageField = 'page';
  private $pageForm = 'pages';

  private $perPageField = 'perPage';
  private $perPageForm = 'perPageLinks';

  private $containerClass = 'pagination';
  private $itemClass = 'pagination__item';
  private $activeClass = 'pagination__item--active';

  private $perPageContainerClass = 'perPageLinks';
  private $perPageItemClass = 'perPageLinks__item';
  private $perPageActiveClass = 'perPageLinks__item--active';

  public function getPage(): int {
    return $this->page;
  }

  public function setPage(int $page): void {
    if(empty($page)) return;
    if($page >= $this->pagesCount) {
      $this->page = $this->pagesCount;
      return;
    }
    
    $this->page = $page;
  }

  public function getPerPage(): int {
    return $this->perPage;
  }

  protected function setPerPage(int $perPage): void {
    if(empty($perPage)) return;
    $maxLimit = $this->getMaxLimit();

    if($perPage > $maxLimit) {
      $this->setPerPage($maxLimit);
    }

    $this->perPage = $perPage;
  }

  protected function getPerPageArray(): array {
    return $this->perPageArray;
  }

  protected function setPerPageArray(array $arr): void {
    if(empty($arr)) return;
    $this->perPageArray = $arr;
  }

  public function getPagesCount(): int {
    return $this->pagesCount;
  }

  protected function setPagesCount(int $totalRows, int $perPage) {
    if(empty($totalRows) || empty($perPage)) return;
    $this->pagesCount = ceil($totalRows / $perPage);
  }
  
  public function getTotalRows(): int {
    return $this->totalRows;
  }

  protected function setTotalRows(int $totalRows): void {
    if(empty($totalRows)) return;
    $this->totalRows = $totalRows;
  }

  public function getMaxLimit(): int {
    return $this->maxLimit;
  }

  protected function setMaxLimit(int $maxLimit): void {
    if(empty($maxLimit)) return;
    $this->maxLimit = $maxLimit;
  }
  
  public function getAction(): string
  {
    return $this->action;
  }

  protected function setAction(string $action): void
  {
    if(empty($action)) return;
    $this->action = $action;
  }

  public function getMethod(): string
  {
    return $this->method;
  }

  protected function setMethod(string $method): void
  {
    if(empty($method)) return;
    $this->method = $method;
  }

  public function getPageField(): string
  {
    return $this->pageField;
  }

  protected function setPageField(string $pageField): void
  {
    if(empty($pageField)) return;
    $this->pageField = $pageField;
  }

  public function getPageForm(): string
  {
    return $this->pageForm;
  }

  protected function setPageForm(string $pageForm): void
  {
    if(empty($pageForm)) return;
    $this->pageForm = $pageForm;
  }

  public function getPerPageField(): string
  {
    return $this->perPageField;
  }

  protected function setPerPageField(string $perPageField): void
  {
    if(empty($perPageField)) return;
    $this->perPageField = $perPageField;
  }

  public function getPerPageForm(): string
  {
    return $this->perPageForm;
  }

  protected function setPerPageForm(string $perPageForm): void
  {
    if(empty($perPageForm)) return;
    $this->perPageForm = $perPageForm;
  }

  protected function getContainerClass(): string
  {
    return $this->containerClass;
  }

  protected function setContainerClass(string $containerClass): void
  {
    $this->containerClass = $containerClass;
  }

  public function getItemClass(): string
  {
    return $this->itemClass;
  }

  protected function setItemClass(string $itemClass): void
  {
    $this->itemClass = $itemClass;
  }

  public function getActiveClass(): string
  {
    return $this->activeClass;
  }

  protected function setActiveClass(string $activeClass): void
  {
    $this->activeClass = $activeClass;
  }

  public function getPerPageContainerClass(): string
  {
    return $this->perPageContainerClass;
  }

  protected function setPerPageContainerClass(string $perPageContainerClass): void
  {
    $this->perPageContainerClass = $perPageContainerClass;
  }

  public function getPerPageItemClass(): string
  {
    return $this->perPageItemClass;
  }

  protected function setPerPageItemClass(string $perPageItemClass): void
  {
    $this->perPageItemClass = $perPageItemClass;
  }

  public function getPerPageActiveClass(): string
  {
    return $this->perPageActiveClass;
  }

  protected function setPerPageActiveClass(string $perPageActiveClass): void
  {
    $this->perPageActiveClass = $perPageActiveClass;
  }

  protected function getPaginationJS(string $formID, string $inputsClass): string {
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

  protected function getSelectJS($formID) {
    return "
      <script>
        const select = document.querySelector('select.button');
        const {$formID} = document.querySelector('#{$formID}');

        select.addEventListener('change', (ev) => {
          ev.preventDefault();
          {$formID}.setAttribute('value', select.value);
          window.pagination.submit();
        });
      </script>
    ";
  }

  protected function createPerPageLinks(array $perPageArray) : string
  {
    if(empty($perPageArray)) {
      return '';
    }
    $perPageLinks = '<div class="'.$this->getPerPageContainerClass().'"><input id="'.$this->getPerPageContainerClass().'" type="hidden" name="'.$this->getPerPageField().'" value="'.$this->getPerPage().'" />';

    $perPageLinks .= '<select class="button">';

    foreach($perPageArray as $pP) {
      $perPageLinks .= '<option ' .($pP === $this->getPerPage() ? 'selected' : null). ' value="'.$pP.'">'.$pP.'</option>';
    }

    $perPageLinks .= '</select></div>';

    $perPageLinks .= $this->getSelectJS($this->getPerPageForm());

    return $perPageLinks;
  }

  protected function hasPrev(int $page, int $offset = 1): bool
  {
    if (!is_int($page) || ($page - $offset) <= 0) {
      return FALSE;
    }
    return TRUE;
  }

  protected function hasNext(int $page, int $offset = 1): bool
  {
    if (!is_int($page) || ($page + $offset) > $this->getPagesCount()) {
      return FALSE;
    }

    return TRUE;
  }

  protected function createLinks(int $page): string
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

  protected function createHiddenPostFields(string $exclude = null): string
  {
    $fields = $this->request->getPost();

    $output = '';

    foreach ($fields as $key => $field) {
      if($key === $exclude) continue;
      $output .= '<input type="hidden" name="' . $key . '" value="' . $field . '" />';
    }

    return $output;
  }

  protected function createGetFields()
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
}