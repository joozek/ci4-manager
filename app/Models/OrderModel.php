<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Adds\Order;

class OrderModel extends Model
{
    protected $table = 'Orders';
    protected $allowedFields = ['UUID', 'Status', 'Shipment', 'Payment', 'Shipping', 'ClientID', 'Date'];
    protected $returnType = 'object';

    public function getOrdersRequest(Order\OrderSortCriteria $criteria = null): Model
    {
        $request = $this->select(['UUID', 'Status', 'Shipping', 'Shipment', 'Payment', 'ClientID', 'Date']);

        if (isset($criteria)) {
            //Get search criteria
            !empty($criteria->getUUID()) ? $request->like('UUID', $criteria->getUUID()) : null;
            !empty($criteria->getStatus()) ? $request->like('Status', $criteria->getStatus()) : null;
            !empty($criteria->getShipping()) ? $request->like('Shipping', $criteria->getShipping()) : null;
            !empty($criteria->getShipment()) ? $request->like('Shipment', $criteria->getShipment()) : null;
            !empty($criteria->getPayment()) ? $request->like('Payment', $criteria->getPayment()) : null;
            !empty($criteria->getClientID()) ? $request->like('ClientID', $criteria->getClientID()) : null;
            !empty($criteria->getDate()) ? $request->like('Date', $criteria->getDate()) : null;

            //Get sort criteria
            !empty($criteria->getSortUUID()) ? $request->orderBy('UUID', $criteria->getSortUUID()) : null;
            !empty($criteria->getSortStatus()) ? $request->orderBy('Status', $criteria->getSortStatus()) : null;
            !empty($criteria->getSortShipping()) ? $request->orderBy('Shipping', $criteria->getSortShipping()) : null;
            !empty($criteria->getSortShipment()) ? $request->orderBy('Shipment', $criteria->getSortShipment()) : null;
            !empty($criteria->getSortPayment()) ? $request->orderBy('Payment', $criteria->getSortPayment()) : null;
            !empty($criteria->getSortClientID()) ? $request->orderBy('ClientID', $criteria->getSortClientID()) : null;
            !empty($criteria->getSortDate()) ? $request->orderBy('Date', $criteria->getSortDate()) : null;
        }

        return $request;
    }

    public function countOrders(Order\OrderSortCriteria $criteria): int
    {
        return $this->getOrdersRequest($criteria)->countAllResults();
    }

    public function getOrders(Order\OrderSortCriteria $criteria = null, int $limit = null, int $offset = null): array
    {
        return $this->getOrdersRequest($criteria)->findAll($limit, $offset);
    }

    public function createOrder($data)
    {
        return $this->insert($data);
    }
}
