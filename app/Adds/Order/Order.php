<?php

namespace App\Adds\Order;

use App\Controllers\Main;
use App\Adds\Pagination;

abstract class Order extends Main
{
    private $defaultLimit = 50;
    private $defaultOffset = 0;

    protected function initialize() {
        helper(['form', 'format']);

        $this->model = model(OrderModel::class);
        $this->postParams = (object) $this->request->getPost();

        $this->criteria = $this->setCriteria($this->postParams);
    }

    protected function setCriteria(object $params): OrderSearchCriteria 
    {
        $criteria = new OrderSearchCriteria();

        // SEARCH CRITERIA
        if(!empty($params->uuid)) {
            $criteria->setUUID($params->uuid);
        }
        if(!empty($params->status)) {
            $criteria->setStatus($params->status);
        }
        if(!empty($params->shipping_total)) {
            $criteria->setShippingTotal($params->shipping_total);
        }
        if(!empty($params->shipment)) {
            $criteria->setShipment($params->shipment);
        }

        // SORT CRITERIA
        if(!empty($params->sort_uuid)) {
            $criteria->setSortUUID($params->sort_uuid);
        }
        if(!empty($params->sort_status)) {
            $criteria->setSortStatus($params->sort_status);
        }
        if(!empty($params->sort_shipping_total)) {
            $criteria->setSortShippingTotal($params->sort_shipping_total);
        }
        if(!empty($params->sort_shipment)) {
            $criteria->setSortShipment($params->sort_shipment);
        }

        return $criteria;
    }

    protected function getOrdersCount() {
        return $this->model->countOrders($this->criteria);
    }

    protected function getOrders($limit, $offset)
    {
        return $this->model->getOrders($this->criteria, $limit, $offset);
    }
}
