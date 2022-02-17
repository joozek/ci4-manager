<?php

namespace App\Adds\Order;

use App\Controllers\Main;
use App\Adds\Pagination;

abstract class Order extends Main
{
    private $defaultLimit = 50;
    private $defaultOffset = 0;

    protected function initialize() {
        $this->model = model(OrderModel::class);
        $this->postParams = (object) $this->request->getPost();

        $this->criteria = $this->setCriteria($this->postParams);
    }

    protected function setCriteria(object $params): OrderSearchCriteria 
    {
        $criteria = new OrderSearchCriteria();

        // Set search criteria
        !empty($params->uuid) ? $criteria->setUUID($params->uuid) : null;
        !empty($params->status) ? $criteria->setStatus($params->status) : null;
        !empty($params->shipping_total) ? $criteria->setShippingTotal($params->shipping_total) : null;
        !empty($params->shipment) ? $criteria->setShipment($params->shipment) : null;

        // Set sort criteria
        !empty($params->sort_uuid) ? $criteria->setSortUUID($params->sort_uuid) : null;
        !empty($params->sort_status) ? $criteria->setSortStatus($params->sort_status) : null;
        !empty($params->sort_shipping_total) ? $criteria->setSortShippingTotal($params->sort_shipping_total) : null;
        !empty($params->sort_shipment) ? $criteria->setSortShipment($params->sort_shipment) : null;

        return $criteria;
    }

    protected function getOrdersCount(): int {
        return $this->model->countOrders($this->criteria);
    }

    protected function getOrders($limit, $offset): array
    {
        return $this->model->getOrders($this->criteria, $limit, $offset);
    }
}
