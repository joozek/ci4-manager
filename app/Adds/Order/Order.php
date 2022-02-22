<?php

namespace App\Adds\Order;

use App\Controllers;
use App\Models;

/**
 * Abstract class defined basic functionalities.
 */
abstract class Order extends Controllers\Main
{
    /**
     * Default orders limit
     * @var int
     */
    protected int $limit = 10;
    /**
     * Max orders limit
     * @var int
     */
    protected int $maxLimit = 50;
    /**
     * Default offset
     * @var int
     */
    protected int $offset = 0;

    /**
     * Get default limit
     * 
     * @return int
     */
    protected function getLimit(): int {
        return !empty($this->params->limit) && $this->params->limit <= $this->maxLimit ? $this->params->limit : $this->limit;
    }

    /**
     * Get perPage from request
     * 
     * @return int
     */
    protected function getPerPage(): int {
        return !empty($this->params->perPage) && $this->params->perPage <= $this->maxLimit ? $this->params->perPage : $this->limit;
    }

    /**
     * Get page from request
     * 
     * @return int
     */
    protected function getPage(): int {
        return !empty($this->params->page) && $this->params->page >= 1 ? $this->parmas->page : 1;
    }

    /**
     * Get offset from request
     * 
     * @return int
     */
    protected function getOffset(): int {
        return !empty($this->params->offset) ? $this->params->offset : $this->offset;
    }

    /**
     * Get number of orders those exists in database.
     * 
     * @return int
     */
    protected function getOrdersCount(): int
    {
        return $this->model->countOrders($this->criteria);
    }

    /**
     * Get orders from database.
     * 
     * @param int|null $limit Number of items.
     * @param int|null $offset Number of cursor position.
     * 
     * @return array
     */
    protected function getOrders(int $limit = null, int $offset = null): array
    {
        return $this->model->getOrders($this->criteria, $limit ?? $this->limit, $offset ?? $this->offset);
    }

    /**
     * Set criteria from object and return created criteria.
     * 
     * @param object $params Request params to search
     * 
     * @return OrderSortCriteria
     */
    protected function setCriteria(object $params): OrderSortCriteria
    {
        $criteria = new OrderSortCriteria();

        // Set search criteria
        foreach((array) $params as $key => $value) {
            if($key === 'limit' || $key === 'offset') continue;
            if($criteria->exists($key)) {
                $criteria->{'set' . ucfirst($key)}($value);
            } else {
                throw new \Exception('Invalid parameter');
            }
        }

        return $criteria;
    }

    /**
     * Initialize model, REQUEST params and set criteria.
     * 
     * @return void
     */
    protected function initialize(): void
    {
        $this->model = model(Models\OrderModel::class);
        $this->params = $this->request->getHeaderLine('Content-Type') === 'application/json' ? $this->request->getJSON() : $this->request->getPost();
        if(is_null($this->params)) {
            throw new \Exception('Params object is invalid.');
        }
        $this->criteria = $this->setCriteria($this->params ?? (object)[]);
    }

}
