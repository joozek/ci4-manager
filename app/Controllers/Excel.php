<?php

namespace App\Controllers;

use App\Models\OrderModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends BaseController
{
    private $spreadSheet;
    private $sheet;

    public function __construct()
    {
        helper('file');

        $this->spreadSheet = new Spreadsheet();
        $this->sheet = $this->spreadSheet->getActiveSheet();
        $this->csvWriter = new Csv($this->spreadSheet);
        $this->xlsxWriter = new Xlsx($this->spreadSheet);
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
            $rowKeys = array_keys($row);

            $index = 0;
            foreach ($rowKeys as $val) {
                $this->sheet->setCellValue($letters[$index++] . $i, $val);
            }
        }
    }

    public function index()
    {
        $model = model(OrderModel::class);

        $orders = $model->getOrders();
        $method = $this->request->getGet('method');

        if (count($orders) === 0) {
            throw new \Exception('No orders found.');
        }

        $this->createSpreadSheet($orders);

        header('Content-Type: ' . getMime($method));
        header('Content-Disposition: attachment; filename="orders.' . ($method ?? 'xlsx') . '"');
        $this->{($method ?? 'xlsx') . 'Writer'}->save("php://output");
    }
}
