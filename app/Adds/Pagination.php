<?php

namespace App\Adds;

use Config\Services;

use App\Adds\Pagination\Methods;

class Pagination extends Methods
{

  public function __construct(array $options)
  {
    // Initialize basic parameters
    !empty($options['perPage']) ? $this->setPerPage($options['perPage']) : null;
    !empty($options['perPageArray']) ? $this->setPerPageArray($options['perPageArray']) : null;

    // Set total rows and max per page limit
    !empty($options['totalRows']) ? $this->setTotalRows($options['totalRows']) : null;
    !empty($options['maxLimit']) ? $this->setMaxLimit($options['maxLimit']) : null;

    // Set pagination work method and default action
    !empty($options['action']) ? $this->setAction($options['action']) : null;
    !empty($options['method']) ? $this->setMethod($options['method']) : null;
    
    // Set page names
    !empty($options['pageField']) ? $this->setPageField($options['pageField']) : null;
    !empty($options['pageForm']) ? $this->setPageForm($options['pageForm']) : null;
    
    // Set perPage names
    !empty($options['perPageField']) ? $this->setPerPageField($options['perPageField']) : null;
    !empty($options['perPageForm']) ? $this->setPerPageForm($options['perPageForm']) : null;

    // Set page classes
    !empty($options['containerClass']) ? $this->setContainerClass($options['containerClass']) : null;
    !empty($options['itemClass']) ? $this->setItemClass($options['itemClass']) : null;
    !empty($options['activeClass']) ? $this->setActiveClass($options['activeClass']) : null;

    // Set perPage classes
    !empty($options['perPageContainerClass']) ? $this->setContainerClass($options['perPageContainerClass']) : null;
    !empty($options['perPageItemClass']) ? $this->setItemClass($options['perPageItemClass']) : null;
    !empty($options['perPageActiveClass']) ? $this->setActiveClass($options['perPageActiveClass']) : null;

    // Set pagesCount
    $this->setPagesCount($this->getTotalRows(), $this->getPerPage());

    // Initialize request
    $this->request = Services::request();
  }

  public function getOffset(): int
  {
    return ($this->getPage() - 1) * $this->getPerPage();
  }

  public function getPagination(int $page)
  {
    $output = '<form id="'.$this->getContainerClass().'" method="' . $this->getMethod() . '" action="' . $this->getAction() . $this->createGetFields() . '">';
    $output .= $this->createHiddenPostFields($this->getPageField());
    $output .= '<input id="' . $this->getPageForm() .'" type="hidden" name="' . $this->getPageField() . '" value="'.$this->getPage().'">';
    $output .= $this->createLinks($page);
    $output .= $this->getPaginationJS($this->getPageForm(), $this->getPageField());
    $output .= $this->createPerPageLinks($this->getPerPageArray());
    $output .= '</form>';

    return $output;
  }
}
