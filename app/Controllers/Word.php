<?php

namespace App\Controllers;

use App\Classes\OrderSearchCriteria;

use App\Models\OrderModel;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;

class Word extends Main {
    private $phpWord;
    private $colSize = 1500;
    private $rowSize = 500;
    private $tableStyles = [
        'borderColor' => '#000000',
        'borderSize' => 1,
        'cellMargin' => 0,
    ];
    private $rowStyles = [
        'cantSplit' => true,
        'fontSize' => 20,
    ];
    private $textStyles = [
        'bold' => true,
        'fontSize' => 20,
    ];

    public function __construct()
    {
        $this->phpWord = new PhpWord();
        $this->section = $this->phpWord->addSection();
        $this->writer = new Word2007($this->phpWord);
    }

    private function createOrdersTable(array $arr)
    {
        $this->phpWord->addTableStyle('orders', $this->tableStyles);
        $table = $this->section->addTable('orders');
        $table->addRow($this->rowSize, $this->rowStyles);

        foreach ($arr[0] as $key => $value) {
            $fieldName = ucwords(str_replace('_', ' ', $key));
            $table->addCell($this->colSize)->addText($fieldName, $this->textStyles);
        }

        for ($i = 0; $i < count($arr); $i++) {
            $table->addRow($this->rowSize, $this->rowStyles);
            $rowKeys = get_object_vars($arr[$i]);
            foreach ($rowKeys as $rowKey) {
                $table->addCell($this->colSize)->addText($rowKey);
            }
        }
    }

    public function index()
    {
        $model = model(OrderModel::class);
        $params = (object) $this->request->getGetPost();

        $limit = $params->limit ?? 500;
        $offset = $params->offset ?? 0;

        $criteria = new OrderSearchCriteria();
        $orders = $model->getOrders($criteria, $limit, $offset);

        if (empty($orders)) {
            throw new \Exception('No orders found.');
        }

        $this->createOrdersTable($orders);

        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; filename="orders.docx"');

        $this->writer->save('php://output');
    }   
}