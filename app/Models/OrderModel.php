<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Classes\OrderSearchCriteria;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $allowedFields = ['uuid', 'status', 'shipment', 'payment', 'shipping_total'];
    protected $returnType = 'object';

    public function getOrdersRequest(OrderSearchCriteria $criteria = null): OrderModel
    {
        $request = $this->select(['uuid', 'status', 'client_id', 'shipment', 'payment', 'shipping_total']);


        if (isset($criteria)) {
            // Search by criteria
            if (!empty(($criteria->getUUID()))) {
                $request->like('uuid', $criteria->getUUID());
            }
            if (!empty($criteria->getStatus())) {
                $request->like('status', $criteria->getStatus());
            }
            if (!empty($criteria->getShippingTotal())) {
                $request->like('shipping_total', $criteria->getShippingTotal());
            }
            if (!empty($criteria->getShipment())) {
                $request->like('shipment', $criteria->getShipment());
            }

            //ORDER CRITERIA
            if (!empty($criteria->getSortUUID())) {
                $request->orderBy('uuid', $criteria->getSortUUID());
            }
            if (!empty($criteria->getSortStatus())) {
                $request->orderBy('status', $criteria->getSortStatus());
            }
            if (!empty($criteria->getSortShippingTotal())) {
                $request->orderBy('shipping_total', $criteria->getSortShippingTotal());
            }
            if (!empty($criteria->getSortShipment())) {
                $request->orderBy('shipment', $criteria->getSortShipment());
            }
        }

        return $request;
    }

    public function countOrders(OrderSearchCriteria $criteria): int
    {
        return $this->getOrdersRequest($criteria)->countAllResults();
    }

    public function getOrders(OrderSearchCriteria $criteria = null, int $limit = null, int $offset = null): array
    {
        $query = $this->getOrdersRequest($criteria)->findAll($limit, $offset);

        return $query;
    }
}
