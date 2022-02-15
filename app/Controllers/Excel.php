<?php

namespace App\Controllers;

use App\Classes\OrderSearchCriteria;

use App\Models\OrderModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends Main {
    private $spreadsheet;
    private $sheet;
    private $xlsxWriter;
    private $csvWriter;

    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
        $this->sheet = $this->spreadsheet->getActiveSheet();
        $this->xlsxWriter = new Xlsx($this->spreadsheet);
        $this->csvWriter = new Csv($this->spreadsheet);
    }

    private function createSpreadSheet(array $arr)
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $index = 0;
        foreach ($arr[0] as $key => $v) {
            $fieldName = ucwords(str_replace('_', ' ', $key));
            $this->sheet->setCellValue($letters[$index++] . '1', $fieldName);
        }

        foreach ($arr as $key => $row) {
            $i = $key + 2;
            $rowKeys = get_object_vars($row);

            $index = 0;
            foreach ($rowKeys as $val) {
                $this->sheet->setCellValue($letters[$index++] . $i, $val);
            }
        }
    }

    public function index()
    {
        helper('file');
        $model = model(OrderModel::class);
        $params = (object) $this->request->getGetPost();

        $limit = $params->limit ?? 500;
        $offset = $params->offset ?? 0;

        $criteria = new OrderSearchCriteria();
        $orders = $model->getOrders($criteria, $limit, $offset);
        $method = $params->format ?? 'xlsx';

        if (count($orders) === 0) {
            throw new Exception('No orders found.');
        }

        $this->createSpreadSheet($orders);


        header('Content-Type: ' . (getMime($method ?? 'xlsx')));
        header('Content-Disposition: attachment; filename="orders.' . ($method ?? 'xlsx') . '"');
        $this->{($method ?? 'xlsx') . 'Writer'}->save("php://output");
    }
}