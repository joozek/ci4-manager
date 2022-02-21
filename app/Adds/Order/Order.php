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
     * Initialize model, postParams and criteria.
     * 
     * @return void
     */
    protected function initialize(): void
    {
        $this->model = model(Models\OrderModel::class);
        $this->postParams = $this->request->getHeaderLine('Content-Type') === 'application/json' ? $this->request->getJSON() : $this->request->getPost();
        $this->criteria = $this->setCriteria($this->postParams);
    }

    /**
     * Set criteria from object and return created criteria.
     * 
     * @param object $params
     * 
     * @return OrderSortCriteria
     */
    protected function setCriteria(object $params): OrderSortCriteria
    {
        $criteria = new OrderSortCriteria();

        // Set search criteria
        !empty($params->UUID) ? $criteria->setUUID($params->UUID) : null;
        !empty($params->Status) ? $criteria->setStatus($params->Status) : null;
        !empty($params->Shipping) ? $criteria->setShipping($params->Shipping) : null;
        !empty($params->Shipment) ? $criteria->setShipment($params->Shipment) : null;
        !empty($params->Payment) ? $criteria->setPayment($params->Payment) : null;
        !empty($params->ClientID) ? $criteria->setClientID($params->ClientID) : null;
        !empty($params->Date) ? $criteria->setDate($params->Date) : null;

        // Set sort criteria
        !empty($params->sortUUID) ? $criteria->setSortUUID($params->sortUUID) : null;
        !empty($params->sortStatus) ? $criteria->setSortStatus($params->sortStatus) : null;
        !empty($params->sortShipping) ? $criteria->setSortShipping($params->sortShipping) : null;
        !empty($params->sortShipment) ? $criteria->setSortShipment($params->sortShipment) : null;
        !empty($params->sortPayment) ? $criteria->setSortPayment($params->sortPayment) : null;
        !empty($params->sortClientID) ? $criteria->setSortClientID($params->sortClientID) : null;
        !empty($params->sortDate) ? $criteria->setSortDate($params->sortDate) : null;

        return $criteria;
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
}
