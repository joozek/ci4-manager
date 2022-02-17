<?php

namespace App\Controllers;

use App\Adds\Order\Order;
use App\Adds\Order\OrderAction;

use App\Adds\Pagination;

class OrderGUI extends Order
{
    public function index() 
    {
        $this->initialize();
        $ordersCount = $this->getOrdersCount();

        $options = [
            'action' => '/',
            'perPage' => $this->postParams->limit ?? 10,
            'totalRows' => $ordersCount,
            'perPageArray' => [5, 10, 25, 50],
        ];

        $paginator = new Pagination($options);

        $page = !empty($this->postParams->page) ? (int) $this->postParams->page : 1;
        $paginator->setPage($page);

        $page = $paginator->getPage();
        $limit = $paginator->getPerPage();
        $offset = $paginator->getOffset($page);

        $guiData = [
            'action' => new OrderAction(),
            'lastLimit' => $limit,
            'form' => $this->postParams,
            'orders' => $this->getOrders($limit, $offset),
            'pagination' => $paginator->getPagination($page),
        ];

        return view('order/index', $guiData);
    }
}
