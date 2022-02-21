<?php

namespace App\Adds\Order;

class OrderSortCriteria extends OrderCriteria
{
    private $sortUUID = null;
    private $sortStatus = null;
    private $sortShipping = null;
    private $sortShipment = null;
    private $sortPayment = null;
    private $sortClientID = null;
    private $sortDate = null;

    private function isValidSortType(string $type = null)
    {
        if ($type !== 'ASC' && $type !== 'DESC') {
            return false;
        }

        return true;
    }

    public function getSortUUID()
    {
        return $this->sortUUID;
    }

    public function getSortStatus()
    {
        return $this->sortStatus;
    }

    public function getSortShipping()
    {
        return $this->sortShipping;
    }

    public function getSortShipment()
    {
        return $this->sortShipment;
    }

    public function getSortPayment()
    {
        return $this->sortPayment;
    }

    public function getSortClientID()
    {
        return $this->sortClientID;
    }

    public function getSortDate()
    {
        return $this->sortDate;
    }

    public function setSortUUID(string $UUID = null): void
    {
        if (!$this->isValidSortType($UUID)) {
            return;
        }

        $this->sortUUID = $UUID;
    }

    public function setSortStatus(string $status = null): void
    {
        if (!$this->isValidSortType($status)) {
            return;
        }

        $this->sortStatus = $status;
    }

    public function setSortShipping(string $shipping = null): void
    {
        if (!$this->isValidSortType($shipping)) {
            return;
        }

        $this->sortShipping = $shipping;
    }

    public function setSortShipment(string $shipment = null): void
    {
        if (!$this->isValidSortType($shipment)) {
            return;
        }

        $this->sortShipment = $shipment;
    }

    public function setSortPayment(string $payment = null): void
    {
        if (!$this->isValidSortType($payment)) {
            return;
        }

        $this->sortPayment = $payment;
    }

    public function setSortClientID(string $clientID = null): void
    {
        if (!$this->isValidSortType($clientID)) {
            return;
        }

        $this->sortClientID = $clientID;
    }

    public function setSortDate(string $date = null): void
    {
        if (!$this->isValidSortType($date)) {
            return;
        }

        $this->sortDate = $date;
    }
}
