<?php

namespace App\Controllers;

use App\Adds;

class OrderGUI extends Adds\Order\Order
{
    public function index()
    {
        helper(['form', 'object']);

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

        $paginator = new Adds\Pagination($options);
        $paginator->setPage($postPage);

        $export = new Adds\ExportButtons();

        $perPage = $paginator->getPerPage();
        $offset = $paginator->getOffset();

        $guiData = [
            'action' => new Adds\Order\OrderAction(),
            'perPageField' => $paginator->getPerPageField(),
            'perPage' => $perPage,
            'form' => $this->postParams,
            'orders' => $this->getOrders($perPage, $offset),
            'pagination' => $paginator->getPagination($paginator->getPage()),
            'export' => $export->getExportButtons(),
        ];

        return view('order/gui', $guiData);
    }
}
