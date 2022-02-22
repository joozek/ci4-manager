<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Adds\Order;

/**
 * OrderModel allows to manage orders in database.
 * 
 * Functions:
 * - Get orders (with limit and offset or no)
 * - Get orders count
 */
class OrderModel extends Model
{
    protected $table = 'Orders';
    protected $allowedFields = ['UUID', 'Status', 'Shipment', 'Payment', 'Shipping', 'ClientID', 'Date'];
    protected $returnType = 'object';

    /**
     * Create request contains criteria. If criteria is empty all orders will be return.
     * 
     * @param Order\OrderSortCriteria $criteria
     * 
     * @return Model
     */
    public function getOrdersRequest(Order\OrderSortCriteria $criteria): Model
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

    /**
     * Return count of orders. If criteria are empty return all orders exists in database.
     * 
     * @param Order\OrderSortCriteria $criteria
     * 
     * @return int
     */
    public function countOrders(Order\OrderSortCriteria $criteria): int
    {
        return $this->getOrdersRequest($criteria)->countAllResults();
    }

    /**
     * Return orders by criteria. If criteria are empty return all orders exists in database.
     * 
     * @param Order\OrderSortCriteria $criteria Object contains search criteria
     * @param int|null $limit Maximum orders that will be return
     * @param int|null $offset Move the database cursor to this position
     * 
     * @return array
     */
    public function getOrders(Order\OrderSortCriteria $criteria, int $limit = null, int $offset = null): array
    {
        return $this->getOrdersRequest($criteria)->findAll($limit, $offset);
    }
}
