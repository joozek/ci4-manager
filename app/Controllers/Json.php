<?php

namespace App\Controllers;

use App\Models\OrderModel;

class Json extends BaseController
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

    function edit()
    {
        $json = getValidJSON($this->input->raw_input_stream);

        $edited = $this->order_model->update_order($json->uuid, $json);

        \var_dump(['Status' => $edited ? 'Updated' : 'Error']);
    }

    function remove()
    {
        $json = getValidJSON($this->input->raw_input_stream);

        $removed = $this->order_model->remove_order($json->uuid);

        \var_dump(['Status' => $removed ? 'Removed' : 'Error']);
    }
}
