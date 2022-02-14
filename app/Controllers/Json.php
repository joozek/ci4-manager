<?php

namespace App\Controllers;

use App\Models\OrderModel;

class Json extends Main
{
    public function __construct()
    {
        helper('json');
        $this->model = model(OrderModel::class);
    }

    function index()
    {
        $reqBody = $this->request->getBody();
        $json = getJSON($reqBody);

        $data = [
            'orders' => $this->model->getOrders($json),
        ];

        $this->response->setJSON($data['orders'], true);

        return $this->response->getJSON();
    }

    function details()
    {
        $json = getValidJSON($this->input->raw_input_stream);
        isUUIDExists($json);

        $data['orders'] = $this->order_model->get_order_details($json->uuid);

        $this->load->view('json/index', $data);
    }

    function create()
    {
        $json = getValidJSON($this->request->getBody());

        $this->model->createOrder($json);
    }
}
