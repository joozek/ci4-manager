<?php

namespace App\Controllers;

use App\Adds\Order;

class JSON extends Order\Order
{
    public function index()
    {
        $this->initialize();

        $orders = $this->model->getOrders($this->criteria, $this->getLimit(), $this->getOffset());

        return $this->response->setJSON(['count' => count($orders), 'orders' => $orders ]);
    }
}
