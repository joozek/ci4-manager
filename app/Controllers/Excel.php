<?php

namespace App\Controllers;

use App\Adds;
use PhpOffice\PhpSpreadsheet;

class Excel extends Adds\Order\Order
{
    private $sheet;

    private function createOrdersTable(array $arr): void
    {
        $data = [];
        $keys = array_keys(get_object_vars($arr[0]));
        $data[] = $keys;

        foreach ($arr as $row) {
            $item = [];
            foreach ($keys as $key) {
                $item[] = $row->{$key};
            }
            $data[] = $item;
        }

        $this->sheet->fromArray($data, null, 'A1');
    }

    public function index()
    {
        helper('file');
        $this->initialize();
        $spreadsheet = new PhpSpreadsheet\Spreadsheet();
        $this->sheet = $spreadsheet->getActiveSheet();

        $limit = $this->getOrdersCount();
        $orders = $this->getOrders($limit, 0);

        $this->createOrdersTable($orders);

        $this->response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="orders.xlsx"');

        $writer = new PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save("php://output");
    }
}
