<?php

namespace App\Controllers;

use App\Adds;
use PhpOffice\PhpWord;

/**
 * Controller that allows export orders as word table.
 */
class Word extends Adds\Order\Order
{
    /**
     * @var PhpWord
     */
    private PhpWord\PhpWord $phpWord;
    /**
     * Width of the columns
     * 
     * @var int
     */
    private int $colSize = 1500;
    /**
     * Width of the rows
     * 
     * @var int
     */
    private int $rowSize = 500;

    private array $tableStyles = [
        'borderColor' => '#000000',
        'borderSize' => 1,
        'cellMargin' => 0,
    ];
    private array $rowStyles = [
        'cantSplit' => true,
        'fontSize' => 20,
    ];
    private array $textStyles = [
        'bold' => true,
        'fontSize' => 20,
    ];

    /**
     * Create orders table in docx document.
     * 
     * @param array $orders
     * 
     * @return void
     */
    private function createOrdersTable(array $orders): void
    {
        $this->phpWord->addTableStyle('orders', $this->tableStyles);
        $table = $this->section->addTable('orders');
        $table->addRow($this->rowSize, $this->rowStyles);

        foreach ($orders[0] as $key => $value) {
            $fieldName = ucwords(str_replace('_', ' ', $key));
            $table->addCell($this->colSize)->addText($fieldName, $this->textStyles);
        }

        for ($i = 0; $i < count($orders); $i++) {
            $table->addRow($this->rowSize, $this->rowStyles);
            $rowKeys = get_object_vars($orders[$i]);
            foreach ($rowKeys as $rowKey) {
                $table->addCell($this->colSize)->addText($rowKey);
            }
        }
    }

    /**
     * Default controller function that create orders table and allow to download it.
     * 
     * @return void
     */
    public function index()
    {
        $this->initialize();
        $limit = $this->getOrdersCount();
        $orders = $this->getOrders($limit, 0);

        $this->phpWord = new PhpWord\PhpWord();
        $this->section = $this->phpWord->addSection();
        $writer = PhpWord\IOFactory::createWriter($this->phpWord, 'Word2007');

        $this->createOrdersTable($orders);

        $this->response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="orders.docx"');
        $writer->save('php://output');
    }
}
