<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Classes\OrderSearchCriteria;
use App\Classes\Pagination;

class Action
{
    public $search = '/';
    public $show = '/?method=show';
    public $remove = '/?method=remove';
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

        $limit = 5;

        if(!empty($postParams->lastLimit)) {
            $intLimit = (int) $postParams->lastLimit;
            $maxLimit = $this->pagination->getMaxLimit();
            if($intLimit > 0) {
                $limit = $intLimit;
                if($intLimit > $maxLimit) {
                    $limit = $maxLimit;
                }
            }
        }

        if(!empty($postParams->limit)) {
            $intLimit = (int) $postParams->limit;
            $maxLimit = $this->pagination->getMaxLimit();
            if($intLimit > 0) {
                $limit = $intLimit;
                if($intLimit > $maxLimit) {
                    $limit = $maxLimit;
                }
            }
        }

        $this->pagination->initialize('/', (int) $limit, $ordersCount);

        $page = 1;

        if(!empty($postParams->page)) {
            $intPage = (int) $postParams->page;
            $maxPage = $this->pagination->getPagesCount();
            if($page > 0) {
                $page = $intPage;
                if($intPage > $maxPage) {
                    $page = $maxPage;
                }   
            }
        }
        $offset = $this->pagination->getOffset($page);

        $arr = [5, 10, 25, 50];

        $data = [
            'action' => new Action(),
            'form' => $postParams,
            'lastLimit' => $limit,
            'links' => $this->pagination->getPagination($page),
            'limitLinks' => $this->pagination->getPerPageLinks($arr),
            'orders' => $model->getOrders($criteria, $limit, $offset),
        ];

        return view('order/index', $data);
    }
}
