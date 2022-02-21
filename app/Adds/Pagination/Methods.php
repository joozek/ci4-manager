<?php

namespace App\Adds\Pagination;

class Methods
{
    // Basic parameteres
    private $perPage = 10;
    private $totalRows = 0;
    private $perPageArray = [];

    // Pagination 
    private $pagesCount = 1;
    private $page = 1;
    private $maxLimit = 500;

    // Pagination form options
    private $action = '';
    private $method = 'POST';

    // Field names
    private $pageField = 'page';
    private $perPageField = 'perPage';

    // Form names
    private $pageForm = 'pages';
    private $perPageForm = 'perPageLinks';

    // Classes for pagination
    private $containerClass = 'pagination';
    private $itemClass = 'pagination__item';
    private $activeClass = 'pagination__item--active';

    // Classes for perPage links
    private $perPageContainerClass = 'perPageLinks';
    private $perPageItemClass = 'perPageLinks__item';
    private $perPageActiveClass = 'perPageLinks__item--active';

    /**
     * Get actual page
     * 
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * Set actual page
     * 
     * @param int $page Number of page available from 0 to $this->pagesCount()
     * 
     * @return self
     */
    public function setPage(int $page): self
    {
        if (empty($page)) {
            return $this;
        }
        if ($page >= $this->pagesCount) {
            $this->page = $this->pagesCount;
            return $this;
        }

        $this->page = $page;

        return $this;
    }

    /**
     * Get items per page. 
     * 
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * Set items per page. Default is 10
     * 
     * @param int $perPage Number of items shows per page.
     * 
     * @return self
     */
    protected function setPerPage(int $perPage = 1): self
    {
        if (empty($perPage)) {
            return $this;
        }

        if ($perPage > $this->maxLimit) {
            $this->perPage = $this->maxLimit;
            return $this;
        }

        $this->perPage = $perPage;

        return $this;
    }

    /**
     * Get array with number of per page items.
     * 
     * @return array
     */
    protected function getPerPageArray(): array
    {
        return $this->perPageArray;
    }

    /**
     * Set array with number of per page items. Default empty array.
     * 
     * @param array $perPageItems Array contains numbers of available limits. Eg [10, 15, 20]
     * 
     * @return self
     */
    protected function setPerPageArray(array $perPageItems = []): self
    {
        if (empty($perPageItems)) {
            return $this;
        }
        $this->perPageArray = $perPageItems;
    
        return $this;
    }

    /**
     * Get number of pages.
     * 
     * @return int
     */
    protected function getPagesCount(): int
    {
        return $this->pagesCount;
    }

    /**
     * Set number of pages.
     * 
     * @param int $totalRows Number of rows that exists in database
     * @param int $perPage Number of perPage items limit.
     * 
     * @return self
     */
    protected function setPagesCount(int $totalRows, int $perPage)
    {
        if (empty($totalRows) || empty($perPage)) {
            return $this;
        }
        $this->pagesCount = ceil($totalRows / $perPage);

        return $this;
    }

    /**
     * Get count of all items available to pagination.
     * 
     * @return int
     */
    protected function getTotalRows(): int
    {
        return $this->totalRows;
    }

    /**
     * Set count of all items available to pagination. 
     * 
     * @param int $totalRows Number of rows that exists in database.
     * 
     * @return self
     */
    protected function setTotalRows(int $totalRows): self
    {
        if (empty($totalRows)) {
            return $this;
        }
        $this->totalRows = $totalRows;
    
        return $this;
    }

    /**
     * Get the max limit of the items per page.
     * 
     * @return int
     */
    public function getMaxLimit(): int
    {
        return $this->maxLimit;
    }

    /**
     * Set the max limit of the items per page. Default: 500
     * 
     * @param int $maxLimit Number of max limit that page can show.
     * 
     * @return self
     */
    protected function setMaxLimit(int $maxLimit): self
    {
        if (empty($maxLimit)) {
            return $this;
        }
        $this->maxLimit = $maxLimit;

        return $this;
    }

    /**
     * Get the form action of pagination.
     * 
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Set the form action of pagination. Default: "/"
     * @param string $action Name of action that you want to use.
     * 
     * @return self
     */
    protected function setAction(string $action): self
    {
        if (empty($action)) {
            return $this;
        }
        $this->action = $action;
        
        return $this;
    }

    /**
     * Get method of pagination form.
     * 
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Set method of pagination form. Default: POST
     * 
     * @param string $method Name of pethod thas you want to use.
     * 
     * @return self
     */
    protected function setMethod(string $method): self
    {
        if (empty($method)) {
            return $this;
        }
        $this->method = $method;

        return $this;
    }

    /**
     * Get name of POST field.
     * 
     * @return string
     */
    public function getPageField(): string
    {
        return $this->pageField;
    }

    /**
     * Set name of POST field. Default is "page".
     * 
     * @param string $pageField Name of pagination field.
     * 
     * @return self
     */
    protected function setPageField(string $pageField): self
    {
        if (empty($pageField)) {
            return $this;
        }
        $this->pageField = $pageField;
    
        return $this;
    }

    /**
     * Get name of pagination form.
     * 
     * @return string
     */
    public function getPageForm(): string
    {
        return $this->pageForm;
    }

    /**
     * Set name of pagination form. Default is "pagination".
     * 
     * @param string $pageForm Name of pagination form.
     * 
     * @return self
     */
    protected function setPageForm(string $pageForm): self
    {
        if (empty($pageForm)) {
            return $this;
        }
        $this->pageForm = $pageForm;

        return $this;
    }

    /**
     * Get name of POST perPage field.
     * 
     * @return string
     */
    public function getPerPageField(): string
    {
        return $this->perPageField;
    }

    /**
     * Set name of POST perPage field. Default is "perPage".
     * 
     * @param string $perPageField Name of perPage Field.
     * 
     * @return self
     */
    protected function setPerPageField(string $perPageField): self
    {
        if (empty($perPageField)) {
            return $this;
        }
        $this->perPageField = $perPageField;

        return $this;
    }

    /**
     * Get name of the perPage form.
     * 
     * @return string
     */
    public function getPerPageForm(): string
    {
        return $this->perPageForm;
    }

    /**
     * Set name of the perPage form. Default is "perPageForm"
     * 
     * @param string $perPageForm Name of perPage form.
     * 
     * @return self
     */
    protected function setPerPageForm(string $perPageForm): self
    {
        if (empty($perPageForm)) {
            return $this;
        }
        $this->perPageForm = $perPageForm;

        return $this;
    }

    /**
     * Get class name for pagination container.
     * 
     * @return string
     */
    protected function getContainerClass(): string
    {
        return $this->containerClass;
    }

    /**
     * Set class name for pagination container.
     * 
     * @param string $containerClass Name of container class.
     * 
     * @return self
     */
    protected function setContainerClass(string $containerClass): self
    {
        $this->containerClass = $containerClass;

        return $this;
    }

    /**
     * Get class name of pagination item.
     * 
     * @return string
     */
    public function getItemClass(): string
    {
        return $this->itemClass;
    }

    /**
     * Set class name of pagination item.
     * 
     * @param string $itemClass Name of item class.
     * 
     * @return self
     */
    protected function setItemClass(string $itemClass): self
    {
        $this->itemClass = $itemClass;
        
        return $this;
    }

    /**
     * Get active item class.
     * 
     * @return string
     */
    public function getActiveClass(): string
    {
        return $this->activeClass;
    }

    /**
     * Set active item class.
     * 
     * @param string $activeClass Name of active item class.
     * 
     * @return self
     */
    protected function setActiveClass(string $activeClass): self
    {
        $this->activeClass = $activeClass;

        return $this;
    }

    /**
     * Get perPage container class
     * 
     * @return string
     */
    public function getPerPageContainerClass(): string
    {
        return $this->perPageContainerClass;
    }

    /**
     * Set perPage container class.
     * 
     * @param string $perPageContainerClass Name of perPage container class
     * 
     * @return self
     */
    protected function setPerPageContainerClass(string $perPageContainerClass): self
    {
        $this->perPageContainerClass = $perPageContainerClass;

        return $this;
    }

    /**
     * Get perPage item class.
     * 
     * @return string
     */
    public function getPerPageItemClass(): string
    {
        return $this->perPageItemClass;
    }

    /**
     * Set perPage item class.
     * 
     * @param string $perPageItemClass Name of perPage item class.
     * 
     * @return self
     */
    protected function setPerPageItemClass(string $perPageItemClass): self
    {
        $this->perPageItemClass = $perPageItemClass;

        return $this;
    }

    /**
     * Get perPage active item class.
     * 
     * @return string
     */
    public function getPerPageActiveClass(): string
    {
        return $this->perPageActiveClass;
    }

    /**
     * Set perPage active item class.
     * 
     * @param string $perPageActiveClass
     * 
     * @return self
     */
    protected function setPerPageActiveClass(string $perPageActiveClass): self
    {
        $this->perPageActiveClass = $perPageActiveClass;

        return $this;
    }

    /**
     * Get Pagination JS. 
     * 
     * @param string $pageInput ID of input that contains "page" field.
     * @param string $linksClass Classname of pagination links
     * 
     * @return string
     */
    protected function getPaginationJS(string $pageInput, string $inputsClass): string
    {
        return <<<HTML
      <script>
        const {$inputsClass} = document.querySelectorAll('.{$inputsClass}');
        const {$pageInput} = document.querySelector('#{$pageInput}');
        window.pagination = document.querySelector('#pagination');

        {$inputsClass}.forEach((input) => {
          input.addEventListener('click', (ev) => {
            ev.preventDefault();
            {$pageInput}.setAttribute('value', ev.target.value);
            window.pagination.submit();
          });
      });
      </script>
    HTML;
    }

    /**
     * Get list of available per page limits.
     * 
     * @param string $selectID ID of select that contains array of per page limits.
     * 
     * @return string
     */
    protected function getSelectJS(string $selectID): string
    {
        return <<<HTML
      <script>
        const select = document.querySelector('select.button');
        const {$selectID} = document.querySelector('#{$selectID}');

        select.addEventListener('change', (ev) => {
          ev.preventDefault();
          {$selectID}.setAttribute('value', select.value);
          window.pagination.submit();
        });
      </script>
    HTML;
    }

    /**
     * Create perPage links from perPageArray
     * 
     * @param array $perPageArray Array contains numbers with available limits. Eg. [ 10, 20, 50]
     * 
     * @return string
     */
    protected function createPerPageLinks(array $perPageArray): string
    {
        if (empty($perPageArray)) {
            return '';
        }
        $perPageLinks = '<div class="'.$this->getPerPageContainerClass().'"><input id="'.$this->getPerPageContainerClass().'" type="hidden" name="'.$this->getPerPageField().'" value="'.$this->getPerPage().'" />';

        $perPageLinks .= '<select class="button">';

        foreach ($perPageArray as $pP) {
            $perPageLinks .= '<option ' .($pP === $this->getPerPage() ? 'selected' : null). ' value="'.$pP.'">'.$pP.'</option>';
        }

        $perPageLinks .= '</select></div>';

        $perPageLinks .= $this->getSelectJS($this->getPerPageForm());

        return $perPageLinks;
    }

    /**
     * Check page has previous element.
     * 
     * @param int $page Actually page number.
     * @param int $shift Number of shits backward. Default is 1.
     * 
     * @return bool
     */
    protected function hasPrev(int $page, int $shift = 1): bool
    {
        if (!is_int($page) || ($page - $shift) <= 0) {
            return false;
        }
        return true;
    }

    /**
     * Check page has next element.
     * 
     * @param int $page Actually page number.
     * @param int $shift Number of forward moves. Default is 1
     * 
     * @return bool
     */
    protected function hasNext(int $page, int $shift = 1): bool
    {
        if (!is_int($page) || ($page + $shift) > $this->getPagesCount()) {
            return false;
        }

        return true;
    }

    /**
     * Create links for pages.
     * 
     * @param int $page Current page number
     * 
     * @return string
     */
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

    /**
     * Create hidden inputs that contains POST data from last request.
     * 
     * @param string|null $exclude Field that have to be exclude form hidden post fields.
     * 
     * @return string
     */
    protected function createHiddenPostFields(string $exclude = null): string
    {
        $fields = $this->request->getPost();

        $output = '';

        foreach ($fields as $key => $field) {
            if ($key === $exclude) {
                continue;
            }
            $output .= '<input type="hidden" name="' . $key . '" value="' . $field . '" />';
        }

        return $output;
    }

    /**
     * Create hidden inputs that contains Query string data from last request.
     * 
     * @return string
     */
    protected function createGetFields(): string
    {
        $fields = $this->request->getGet();
        $fieldsCount = count($fields);
        if ($fieldsCount === 0) {
            return '';
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
