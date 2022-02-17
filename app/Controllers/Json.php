<?php

namespace App\Controllers;

use App\Adds\Order\Order;

class JSON extends Order {
  public function index() {
    helper('console');
    $this->initialize();

    $limit = (int) $this->getOrdersCount();

    $data = [
      'orders' => $this->getOrders($limit, 0),
    ];

    return $this->response->setJSON($data);
  }
}