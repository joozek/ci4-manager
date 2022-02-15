<?php

namespace App\Classes;

class OrderCreateCriteria extends OrderCriteria {
    public $uuid = null;
    public $status = null;
    public $shipment = null;
    public $shipping_total = null;
    public $client_id = null;
    public $date = null;
    public $payment = null;

    public function getClientID() {
        return $this->clientID;
    }

    public function getDate() {
        return $this->date;
    }

    public function payment() {
        return $this->payment;
    }

    public function setUUID(string $uuid = null): void {
        if(preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/', $uuid)) {
            throw new \Exception('UUID is invalid. Valid UUID: 00000000-0000-000-9000-000000000000');
        }

        $this->uuid = $uuid;
    }

    public function setStatus(string $status = null): void {
        $validStatuses = [
            'ORDER_COMPLETED', 'ORDER_CANCELLED', 'ORDER_RETURNED', 
            'ORDER_DELIVERED', 'ORDER_TRANSFERED_TO_FULFILLER',
            'ORDER_TRANSFERED_TO_CARRIER', 'ORDER_PROCESSED'
        ];

        if(!in_array($status, $validStatuses)) {
            throw new \Exception('Invalid status. Valid status are one of following: '. implode(', ', $validStatuses));
        }

        $this->status = $status;
    }

    public function setShippingTotal(string $shippingTotal = null): void {
        if(!is_float($shippingTotal + 0)) {
            throw new \Exception('Shipping Total is invalid. Valid shipping total is real number.');
        }
        
        $this->shipping_total = $shippingTotal;
    }

    public function setShipment(string $shipment = null): void {
        $validShipments= ['SATURDAY', 'BY_NOON', "REGULAR"];

        if(!in_array($shipment, $validShipments)) {
            throw new \Exception('Invalid shipment. Valid shipments are one of following: '. implode(', ', $validShipments));
        }

        $this->shipment = $shipment;
    }

    public function setClientID(string $clientID) {
        if(!preg_match('/[A-Z]{2}-[0-9]{3}/', $clientID)) {
            throw new \Exception('ClientID is invalid.');
        }
    
        $this->client_id = $clientID;
    }

    public function setDate(string $date) {
        if(!preg_match('/[1-9]\d{3}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2|/', $date)) {
            throw new \Exception('Date is invalid. Valid date: 2001-08-24 06:45:00');
        }

        $this->date = $date;
    }

    public function setPayment(string $payment) {
        if($payment !== 'CASH' && $payment !== 'TRANSFER') {
            throw new \Exception('Payment is invalid. Valid payments: CASH or TRANSFER.');
        }

        $this->payment = $payment;
    }
}