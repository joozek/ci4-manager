<?php

namespace App\Controllers;

use App\Models\OrderModel;

class Order extends BaseController
{
    public function index()
    {
        $model = model(OrderModel::class);
        helper('form');

        $criteria = $this->request->getGet();

        $data = [
            'orders' => $model->getOrdersRequest($criteria)->paginate(10),
            'form' => $criteria,
            'pager' => $model->pager,
            'action' => (object) [
                'search' => '/',
                'show' => '/',
                'create' => '/',
                'remove' => '/',
            ],
        ];

        return view('order/index', $data);
    }
}
