<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Classes\OrderSearchCriteria;
use App\Classes\Pagination;

class Action
{
    public $search = '/';
    public $json = '/?format=json';
    public $xlsx = '/?format=xlsx';
    public $csv = '/?format=csv';
    public $docx = '/?format=docx';
}

class Order extends Main
{
    public function __construct()
    {
        $this->pagination = new Pagination();
    }

    private function setCriteria(object $params): OrderSearchCriteria
    {
        $criteria = new OrderSearchCriteria();

        if (!empty($params->uuid)) {
            $criteria->setUUID($params->uuid);
        }
        if (!empty($params->status)) {
            $criteria->setStatus($params->status);
        }
        if (!empty($params->shipping_total)) {
            $criteria->setShippingTotal($params->shipping_total);
        }
        if (!empty($params->shipment)) {
            $criteria->setShipment($params->shipment);
        }
        if (!empty($params->sort_uuid)) {
            $criteria->setSortUUID($params->sort_uuid);
        }
        if (!empty($params->sort_status)) {
            $criteria->setSortStatus($params->sort_status);
        }
        if (!empty($params->sort_shipping_total)) {
            $criteria->setSortShippingTotal($params->sort_shipping_total);
        }
        if (!empty($params->sort_shipment)) {
            $criteria->setSortShipment($params->sort_shipment);
        }

        return $criteria;
    }

    private function export(string $format)
    {
        if ($format === 'xlsx' || $format === 'csv') {
            redirect('/excel?format=' . $format, 'location', 301);
        } elseif ($format === 'docx') {
            redirect('/word', 'location', 301);
        } elseif ($format === 'json') {
            redirect('/json', 'location', 301);
        }
    }

    public function index()
    {
        $model = model(OrderModel::class);
        helper(['form', 'format']);

        $postParams = (object) $this->request->getPost();
        $getParams = (object) $this->request->getGet();

        if (!empty($getParams->format)) {
            $this->export($getParams->format);
        }

        $criteria = $this->setCriteria($postParams);
        $ordersCount = $model->countOrders($criteria);

        $limit = $postParams->limit ?? 5;
        $this->pagination->initialize('/', $limit, $ordersCount);

        $page = (int) ($postParams->page ?? 1);
        $offset = $this->pagination->getOffset($page);

        $data = [
            'action' => new Action(),
            'form' => $postParams,
            'links' => $this->pagination->getPagination($page),
            'orders' => $model->getOrders($criteria, $limit, $offset),
        ];

        return view('order/index', $data);
    }

    public function create()
    {
        $model = model(OrderModel::class);
        helper('form`');

        $criteria = $this->request->getPost();

        $model->createOrder($criteria);
    }
}
