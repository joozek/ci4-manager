<?php

namespace App\Controllers;

use App\Adds\Order\Order;

class JSON extends Order {
  public function index() {
    $this->initialize();

    $limit = $this->getOrdersCount();
    $orders = $this->getOrders($limit, 0);

    return $this->response->setJSON($orders);
  }
} 