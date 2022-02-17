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

        $postPerPage = !empty($this->postParams->perPage) ? (int) $this->postParams->perPage : 10;
        $postPage = !empty($this->postParams->page) ? (int) $this->postParams->page : 1;

        $options = [
            'action' => '/',
            'perPage' => $postPerPage,
            'totalRows' => $ordersCount,
            'perPageArray' => [5, 10, 15, 20, 25],
        ];

        $paginator = new Pagination($options);
        $paginator->setPage($postPage);

        $perPage = $paginator->getPerPage();
        $offset = $paginator->getOffset();

        $guiData = [
            'action' => new OrderAction(),
            'perPageField' => $paginator->getPerPageField(),
            'perPage' => $perPage, 
            'form' => $this->postParams,
            'orders' => $this->getOrders($perPage, $offset),
            'pagination' => $paginator->getPagination($paginator->getPage()),
        ];

        return view('order/index', $guiData);
    }
}
