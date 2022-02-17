<?php

namespace App\Controllers;

use App\Adds\Order\Order;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends Order
{
    private $spreadsheet;
    private $sheet;

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

    private function getMime(string $method): string {
      if($method === 'csv') {
        return 'text/csv';
      }

      return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    }

    public function index()
    {
      helper('file');
      $this->initialize();

      $method = $this->request->getGet('method') ?? 'xlsx';

      $limit = $this->getOrdersCount();
      $orders = $this->getOrders($limit, 0);

      $this->createSpreadSheet($orders);

      $this->response->setHeader('Content-Type', $this->getMime($method));
      $this->response->setHeader('Content-Disposition', 'attachment; filename="orders.'.$method.'"');
      $this->{($method ?? 'xlsx') . 'Writer'}->save("php://output");
    }
}
