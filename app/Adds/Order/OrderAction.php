<?php

namespace App\Adds\Order;

/**
 * Class contains form actions for OrderGUI
 */
class OrderAction
{
    /**
     * Action for search form
     * 
     * @var string
     */
    public string $search = '/';
    /**
     * Action for show order details
     * 
     * @var string
     */
    public string $show = '/?method=show';
    /**
     * Action for edit order
     * 
     * @var string
     */
    public string $remove = '/?method=remove';
    /**
     * Action for create order
     * 
     * @var string
     */
    public string $create = '';
    /**
     * Action for JSON orders view
     * 
     * @var string
     */
    public string $json = '/json';
    /**
     * Action of export via XLSX format
     * 
     * @var string
     */
    public string $xlsx = '/excel?format=xlsx';
    /**
     * Action of export via DOCX format
     * 
     * @var string
     */
    public string $docx = '/word';
}
