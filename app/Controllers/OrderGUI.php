<?php

namespace App\Controllers;

use App\Adds;

/**
 * Controller that show GUI in browser.
 * 
 * Basic functions:
 * - View order basic info
 * - Paginate the orders
 */
class OrderGUI extends Adds\Order\Order
{
    /**
     * Show GUI and initialize pagination
     * 
     * @return void
     */
    public function index()
    {
        helper(['form', 'view']);
        $this->initialize();

        $options = [
            'action' => '/',
            'perPage' => $this->getPerPage(),
            'totalRows' => $this->getOrdersCount(),
            'perPageArray' => [5, 10, 15, 20, 25],
        ];

        $paginator = new Adds\Pagination($options);
        $paginator->setPage($this->getPage());

        $export = new Adds\ExportButtons();

        $guiData = [
            'action' => new Adds\Order\OrderAction(),
            'perPageField' => $paginator->getPerPageField(),
            'perPage' => $paginator->getPerPage(),
            'form' => $this->postParams,
            'orders' => $this->getOrders($paginator->getPerPage(), $paginator->getOffset()),
            'pagination' => $paginator->getPagination($paginator->getPage()),
            'export' => $export->getExportButtons(),
        ];

        return view('order/gui', $guiData);
    }
}
