<?php

namespace App\Adds\Order;

class OrderAction
{
    public $search = '/';
    public $show = '/?method=show';
    public $remove = '/?method=remove';
    public $json = '/json';
    public $xlsx = '/excel?format=xlsx';
    public $csv = '/excel?format=csv';
    public $docx = '/word';
}
