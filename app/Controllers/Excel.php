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
  private $xlsxWriter;
  private $csvWriter;

  public function __construct()
  {
      $this->spreadsheet = new Spreadsheet();
      $this->sheet = $this->spreadsheet->getActiveSheet();
      $this->xlsxWriter = new Xlsx($this->spreadsheet);
      $this->csvWriter = new Csv($this->spreadsheet);
  }

  private function createOrdersTable(array $arr): void
  {
    $data = [];
    $keys = array_keys(get_object_vars($arr[0]));
    $data[] = $keys;

    foreach($arr as $row) {
      $item = [];
      foreach($keys as $key) {
        $item[] = $row->{$key};
      }
      $data[] = $item;
    }

    $this->sheet->fromArray($data, NULL, 'A1');
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

    $this->createOrdersTable($orders);

    $this->response->setHeader('Content-Type', $this->getMime($method));
    $this->response->setHeader('Content-Disposition', 'attachment; filename="orders.'.$method.'"');
    $this->{($method ?? 'xlsx') . 'Writer'}->save("php://output");
  }
}
