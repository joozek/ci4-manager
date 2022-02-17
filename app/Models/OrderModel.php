<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Adds\Order\OrderSearchCriteria;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $allowedFields = ['uuid', 'status', 'shipment', 'payment', 'shipping_total', 'date', 'client_id'];
    protected $returnType = 'object';

    public function getOrdersRequest(OrderSearchCriteria $criteria = null): Model
    {
        
        $request = $this->select(['uuid', 'status', 'shipping_total', 'shipment']);

        if (isset($criteria)) {
            //Get search criteria
            !empty($criteria->getUUID()) ? $request->like('uuid', $criteria->getUUID()) : null;
            !empty($criteria->getStatus()) ? $request->like('status', $criteria->getStatus()) : null;
            !empty($criteria->getShippingTotal()) ? $request->like('shipping_total', $criteria->getShippingTotal()) : null;
            !empty($criteria->getShipment()) ? $request->like('shipment', $criteria->getShipment()) : null;
            
            //Get sort criteria
            !empty($criteria->getSortUUID()) ? $request->orderBy('uuid', $criteria->getSortUUID()) : null;
            !empty($criteria->getSortStatus()) ? $request->orderBy('status', $criteria->getSortStatus()) : null;
            !empty($criteria->getSortShippingTotal()) ? $request->orderBy('shipping_total', $criteria->getSortShippingTotal()) : null;
            !empty($criteria->getSortShipment()) ? $request->orderBy('shipment', $criteria->getSortShipment()) : null;
        }

        return $request;
    }

    public function countOrders(OrderSearchCriteria $criteria): int
    {
        return $this->getOrdersRequest($criteria)->countAllResults();
    }

    public function getOrders(OrderSearchCriteria $criteria = null, int $limit = null, int $offset = null): array
    {
        return $this->getOrdersRequest($criteria)->findAll($limit, $offset);
    }

    public function createOrder($data) {
        return $this->insert($data);
    }
}
