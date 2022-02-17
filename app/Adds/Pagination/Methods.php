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

  private $limitField = 'limit';
  private $limitForm = 'limitLinks';

  private $containerClass = 'pagination';
  private $itemClass = 'pagination__item';
  private $activeClass = 'pagination__item--active';

  private $limitContainerClass = 'limitLinks';
  private $limitItemClass = 'limitLinks__item';
  private $limitActiveClass = 'limitLinks__item--active';

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
    if(empty($this->perPageArray)) return [$this->perPage];
    return $this->perPageArray;
  }

  protected function setPerPageArray(array $arr): void {
    if(empty($arr)) return;
    $this->perPageArray = $arr;
  }

  protected function getPagesCount(): int {
    return $this->pagesCount;
  }

  protected function setPagesCount(int $totalRows, int $perPage) {
    if(empty($totalRows) || empty($perPage)) return;
    $this->pagesCount = ceil($totalRows / $perPage);
  }
  
  protected function getTotalRows(): int {
    return $this->totalRows;
  }

  protected function setTotalRows(int $totalRows): void {
    if(empty($totalRows)) return;
    $this->totalRows = $totalRows;
  }

  protected function getMaxLimit(): int {
    return $this->maxLimit;
  }

  protected function setMaxLimit(int $maxLimit): void {
    if(empty($maxLimit)) return;
    $this->maxLimit = $maxLimit;
  }
  
  protected function getAction(): string
  {
    return $this->action;
  }

  protected function setAction(string $action): void
  {
    if(empty($action)) return;
    $this->action = $action;
  }

  protected function getMethod(): string
  {
    return $this->method;
  }

  protected function setMethod(string $method): void
  {
    if(empty($method)) return;
    $this->method = $method;
  }

  protected function getPageField(): string
  {
    return $this->pageField;
  }

  protected function setPageField(string $pageField): void
  {
    if(empty($pageField)) return;
    $this->pageField = $pageField;
  }

  protected function getPageForm(): string
  {
    return $this->pageForm;
  }

  protected function setPageForm(string $pageForm): void
  {
    if(empty($pageForm)) return;
    $this->pageForm = $pageForm;
  }

  protected function getLimitField(): string
  {
    return $this->limitField;
  }

  protected function setLimitField(string $limitField): void
  {
    if(empty($limitField)) return;
    $this->limitField = $limitField;
  }

  public function getLimitForm(): string
  {
    return $this->limitForm;
  }

  protected function setLimitForm(string $limitForm): void
  {
    if(empty($limitForm)) return;
    $this->limitForm = $limitForm;
  }


  protected function getContainerClass(): string
  {
    return $this->containerClass;
  }

  protected function setContainerClass(string $containerClass): void
  {
    $this->containerClass = $containerClass;
  }

  protected function getItemClass(): string
  {
    return $this->itemClass;
  }


  protected function setItemClass(string $itemClass): void
  {
    $this->itemClass = $itemClass;
  }


  protected function getActiveClass(): string
  {
    return $this->activeClass;
  }

  protected function setActiveClass(string $activeClass): void
  {
    $this->activeClass = $activeClass;
  }

  protected function getLimitContainerClass(): string
  {
    return $this->limitContainerClass;
  }

  protected function setLimitContainerClass(string $limitContainerClass): void
  {
    $this->limitContainerClass = $limitContainerClass;
  }

  protected function getLimitItemClass(): string
  {
    return $this->limitItemClass;
  }

  protected function setLimitItemClass(string $limitItemClass): void
  {
    $this->limitItemClass = $limitItemClass;
  }

  protected function getLimitActiveClass(): string
  {
    return $this->limitActiveClass;
  }

  protected function setLimitActiveClass(string $limitActiveClass): void
  {
    $this->limitActiveClass = $limitActiveClass;
  }
}