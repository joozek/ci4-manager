<?php

namespace App\Controllers;

use App\Adds\Order;

/**
 * Controller that allows management orders from JSON.
 */
class JSON extends Order\Order
{
    /**
     * Show the orders as JSON.
     * 
     * @return void
     */
    public function index()
    {
        $this->initialize();

        $orders = $this->model->getOrders($this->criteria, $this->getLimit(), $this->getOffset());

        return $this->response->setJSON(['count' => count($orders), 'orders' => $orders ]);
    }
}
