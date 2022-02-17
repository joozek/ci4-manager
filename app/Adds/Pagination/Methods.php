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

  public function getPage() {
    return $this->page;
  }

  public function setPage(int $page) {
    if(empty($page)) return;
    if($page > $this->pagesCount) {
      return $this->pagesCount;
    }
    
    $this->page = $page;
  }

  public function getPerPage() {
    return $this->perPage;
  }

  protected function setPerPage(int $perPage) {
    if(empty($perPage)) return;
    $maxLimit = $this->getMaxLimit();

    if($perPage > $maxLimit) {
      $this->setPerPage($maxLimit);
    }

    $this->perPage = $perPage;
  }

  protected function getPerPageArray() {
    if(empty($this->perPageArray)) return [$this->perPage];
    return $this->perPageArray;
  }

  protected function setPerPageArray(array $arr) {
    if(empty($arr)) return;
    $this->perPageArray = $arr;
  }

  protected function getPagesCount() {
    return $this->pagesCount;
  }

  protected function setPagesCount(int $totalRows, int $perPage) {
    if(empty($totalRows) || empty($perPage)) return;
    $this->pagesCount = ceil($totalRows / $perPage);
  }
  
  protected function getTotalRows() {
    return $this->totalRows;
  }

  protected function setTotalRows(int $totalRows) {
    if(empty($totalRows)) return;
    $this->totalRows = $totalRows;
  }

  protected function getMaxLimit() {
    return $this->maxLimit;
  }

  protected function setMaxLimit(int $maxLimit) {
    if(empty($maxLimit)) return;
    $this->maxLimit = $maxLimit;
  }
  
  protected function getAction()
  {
    return $this->action;
  }

  protected function setAction(string $action)
  {
    if(empty($action)) return;
    $this->action = $action;
  }

  protected function getMethod()
  {
    return $this->method;
  }

  protected function setMethod($method)
  {
    if(empty($method)) return;
    $this->method = $method;
  }

  protected function getPageField()
  {
    return $this->pageField;
  }

  protected function setPageField($pageField)
  {
    if(empty($pageField)) return;
    $this->pageField = $pageField;
  }

  protected function getPageForm()
  {
    return $this->pageForm;
  }

  protected function setPageForm($pageForm)
  {
    if(empty($pageForm)) return;
    $this->pageForm = $pageForm;
  }

  protected function getLimitField()
  {
    return $this->limitField;
  }

  protected function setLimitField($limitField)
  {
    if(empty($limitField)) return;
    $this->limitField = $limitField;
  }

  protected function getLimitForm()
  {
    return $this->limitForm;
  }

  protected function setLimitForm($limitForm)
  {
    if(empty($limitForm)) return;
    $this->limitForm = $limitForm;
  }


  protected function getContainerClass()
  {
    return $this->containerClass;
  }

  protected function setContainerClass($containerClass)
  {
    $this->containerClass = $containerClass;
  }

  protected function getItemClass()
  {
    return $this->itemClass;
  }


  protected function setItemClass($itemClass)
  {
    $this->itemClass = $itemClass;
  }


  protected function getActiveClass()
  {
    return $this->activeClass;
  }

  protected function setActiveClass($activeClass)
  {
    $this->activeClass = $activeClass;
  }

  protected function getLimitContainerClass()
  {
    return $this->limitContainerClass;
  }

  protected function setLimitContainerClass($limitContainerClass)
  {
    $this->limitContainerClass = $limitContainerClass;
  }

  protected function getLimitItemClass()
  {
    return $this->limitItemClass;
  }

  protected function setLimitItemClass($limitItemClass)
  {
    $this->limitItemClass = $limitItemClass;
  }

  protected function getLimitActiveClass()
  {
    return $this->limitActiveClass;
  }

  protected function setLimitActiveClass($limitActiveClass)
  {
    $this->limitActiveClass = $limitActiveClass;
  }
}