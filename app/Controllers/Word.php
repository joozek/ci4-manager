<?php

namespace App\Controllers;

use App\Adds\Order\Order;

use \PhpOffice\PhpWord\PhpWord;
use \PhpOffice\PhpWord\IOFactory;

class Word extends Order
{
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
        $this->writer = IOFactory::createWriter($this->phpWord, 'Word2007');
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
  
    private function getMime() {
      return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    }

    public function index()
    {
      $this->initialize();
      $limit = $this->getOrdersCount();
      $orders = $this->getOrders($limit, 0);

      $this->createOrdersTable($orders);

      $this->response->setHeader('Content-Type',  $this->getMime());
      $this->response->setHeader('Content-Disposition', 'attachment; filename="orders.docx"');
      $this->writer->save('php://output');
  }
}