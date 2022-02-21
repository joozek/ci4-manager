<?php

namespace App\Controllers;

use App\Adds\Order;

class JSON extends Order\Order
{
    public function index()
    {
        $this->initialize();

        $limit = !empty($this->postParams->limit) && $this->postParams->limit <= $this->maxLimit ? $this->postParams->limit : $this->limit;
        $offset = !empty($this->postParams->offset) ? $this->postParams->offset : $this->offset;

        $orders = $this->model->getOrders($this->criteria, $limit, $offset);
        return $this->response->setJSON(['count' => count($orders), 'orders' => $orders ]);
    }
}
