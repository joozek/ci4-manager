<?php

namespace App\Controllers;

use App\Adds\Order\Order;
use App\Adds\Order\OrderAction;

use App\Adds\Pagination;

class OrderGUI extends Order
{
    public function index() 
    {
        helper(['form', 'object', 'console']);

        $this->initialize();
        $ordersCount = $this->getOrdersCount();

        $perPage = !empty($this->postParams->limit) ? (int) $this->postParams->limit : 10;

        $options = [
            'action' => '/',
            'perPage' => $perPage,
            'totalRows' => $ordersCount,
            'perPageArray' => [5, 10, 25, 50],
        ];

        $paginator = new Pagination($options);

        $postPage = !empty($this->postParams->page) ? (int) $this->postParams->page : 1;
        $paginator->setPage($postPage);

        $page = $paginator->getPage();
        $limit = $paginator->getPerPage();
        $offset = $paginator->getOffset($page);

        $guiData = [
            'action' => new OrderAction(),
            'form' => $this->postParams,
            'orders' => $this->getOrders($limit, $offset),
            'pagination' => $paginator->getPagination($page),
        ];

        return view('order/index', $guiData);
    }
}
