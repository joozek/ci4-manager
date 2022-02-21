<?php

namespace App\Adds\Order;

class OrderCriteria
{
    private $UUID = null;
    private $Status = null;
    private $Shipping = null;
    private $Shipment = null;
    private $Payment = null;
    private $ClientID = null;
    private $Date = null;

    public function getUUID()
    {
        return $this->UUID;
    }

    public function getStatus()
    {
        return $this->Status;
    }

    public function getShipping()
    {
        return $this->Shipping;
    }

    public function getShipment()
    {
        return $this->Shipment;
    }

    public function getPayment()
    {
        return $this->Payment;
    }

    public function getClientID()
    {
        return $this->ClientID;
    }

    public function getDate()
    {
        return $this->Date;
    }

    public function setUUID(string $UUID = null): void
    {
        $this->UUID = $UUID;
    }

    public function setStatus(string $Status = null): void
    {
        $this->Status = $Status;
    }

    public function setShipping(string $Shipping = null): void
    {
        $this->Shipping = (float) $Shipping;
    }

    public function setShipment(string $Shipment): void
    {
        $this->Shipment = $Shipment;
    }

    public function setPayment(string $Payment): void
    {
        $this->Payment = $Payment;
    }

    public function setClientID(string $ClientID): void
    {
        $this->ClientID = $ClientID;
    }

    public function setDate(string $Date): void
    {
        $this->Date = $Date;
    }
}
