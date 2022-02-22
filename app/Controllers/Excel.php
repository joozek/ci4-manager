<?php

namespace App\Controllers;

use App\Adds;
use PhpOffice\PhpSpreadsheet;

/**
 * Controller that allows export orders as excel table.
 */
class Excel extends Adds\Order\Order
{
    private $sheet;

    /**
     * Create excel table contains orders.
     * 
     * @param array $orders Array contains orders
     * 
     * @return self
     */
    private function createOrdersTable(array $orders): self
    {
        $keys = array_keys(get_object_vars($orders[0]));
        $data = [$keys];

        foreach ($orders as $row) {
            $item = [];
            foreach ($keys as $key) {
                $item[] = $row->{$key};
            }
            $data[] = $item;
        }

        $this->sheet->fromArray($data, null, 'A1');
        
        return $this;
    }

    /**
     * Download the excel spreadsheet contains orders.
     * 
     * @return void
     */
    public function index()
    {
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
