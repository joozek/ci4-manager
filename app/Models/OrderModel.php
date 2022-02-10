<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';

    public function getOrdersRequest(array $criteria = null): OrderModel
    {
        $request = $this->select(['uuid', 'status', 'client_id', 'shipment', 'payment', 'shipping_total']);
        if (!empty($criteria)) {
            if (array_key_exists('uuid', $criteria)) {
                $request->like('uuid', $criteria['uuid']);
            }
            if (array_key_exists('payment', $criteria)) {
                $request->like('payment', $criteria['payment']);
            }
            if (array_key_exists('date', $criteria)) {
                $request->like('date', $criteria['date']);
            }
            if (array_key_exists('client_id', $criteria)) {
                $request->like('client_id', $criteria['client_id']);
            }
            if (array_key_exists('status', $criteria)) {
                $request->like('status', $criteria['status']);
            }
            if (array_key_exists('shipping_total', $criteria)) {
                $request->like('shipping_total', $criteria['shipping_total']);
            }
            if (array_key_exists('shipment', $criteria)) {
                $request->like('shipment', $criteria['shipment']);
            }
            if (array_key_exists('order_by', $criteria)) {
                if (array_key_exists('is_desc', $criteria)) {
                    $asc = $criteria['is_desc'] === 'on' ? 'DESC' : "ASC";
                    $request->orderBy($criteria['order_by'], $asc);
                }
            }
        }

        return $request;
    }

    public function getOrdersLimit(int $limit, int $offset = 0): array
    {
        return $this->getOrdersRequest()->limit($limit, $offset)->findAll();
    }

    public function getOrdersCount(array $criteria): int
    {
        return $this->getOrdersRequest($criteria)->countAllResults();
    }

    public function getOrders(array $criteria = null): array
    {
        return $this->getOrdersRequest($criteria)->findAll();
    }

    // public function getOrdersWithProductsRequest($uuid): OrderModel
    // {
    //     return $this
    //         ->select('*, orders.uuid o_uuid')
    //         ->join('order_products', 'orders.id = order_products.order_id')
    //         ->join('products', 'order_products.id = products.id')
    //         ->where(['orders.uuid' => $uuid]);
    // }

    // public function getOrdersWithProducts(string $uuid)
    // {
    //     return $this->getOrdersWithProductsRequest($uuid)->findAll();
    // }
}
