<?php

namespace App\Adds\Order;

/**
 * OrderCriteria that allows to create search criteria object with additional sorting.
 */
class OrderSortCriteria extends OrderCriteria
{
    /**
     * It accepts two values: ASC, DESC and sorting orders by UUID or no (if null)
     * 
     * @var string|null
     */
    private $sortUUID = null;
    /**
     * It accepts two values ASC, DESC and sorting orders by status or no (if null).
     * 
     * @var string|null
     */
    private $sortStatus = null;
    /**
     * It accepts two values ASC, DESC and sorting orders by shipping or no (if null)
     * 
     * @var string|null
     */
    private $sortShipping = null;
    /**
     * It accepts two values ASC, DESC and sorting orders by shipment or no (if null)
     * 
     * @var string|null
     */
    private $sortShipment = null;
    /**
     * It accepts two values ASC, DESC and sorting orders by payment or no (if null)
     * 
     * @var string|null
     */
    private $sortPayment = null;
    /**
     * It accepts two values ASC, DESC and sorting orders by cliendID or no (if null)
     * 
     * @var string|null
     */
    private $sortClientID = null;
    /**
     * It accepts two values: ASC DESC and sorting orders by Date or no (if null)
     * @var string|null
     */
    private $sortDate = null;

    /**
     * Check type is a valid sort type. Valid sort types: ASC or DESC (null meaning no sort).
     * 
     * @param string|null $type
     * 
     * @return bool
     */
    private function isValidSortType(string $type = null): bool
    {
        if ($type !== 'ASC' && $type !== 'DESC') {
            return false;
        }

        return true;
    }

    /**
     * If set return a type of UUID sorting. If is null sorting is off.
     * 
     * @return string
     */
    public function getSortUUID(): string|null
    {
        return $this->sortUUID;
    }

    /**
     *  If set return a type of status sorting. If is null sorting is off.
     * 
     * @return string
     */
    public function getSortStatus(): string|null
    {
        return $this->sortStatus;
    }

    /**
     * If set return a type of shipping sorting. If is null sorting is off.
     * 
     * @return string
     */
    public function getSortShipping(): string|null
    {
        return $this->sortShipping;
    }

    /**
     *  If set return a type of shipment sorting. If is null sorting is off.
     * 
     * @return string
     */
    public function getSortShipment(): string|null
    {
        return $this->sortShipment;
    }

    /**
     * If set return a type of payment sorting. If is null sorting is off.
     * 
     * @return string
     */
    public function getSortPayment(): string|null
    {
        return $this->sortPayment;
    }

    /**
     * If set return a type of clientID sorting. If is null sorting is off.
     * 
     * @return string
     */
    public function getSortClientID(): string|null
    {
        return $this->sortClientID;
    }

    /**
     * If set return a type of date sorting. If is null sorting is off.
     * 
     * @return string
     */
    public function getSortDate(): string|null
    {
        return $this->sortDate;
    }

    
    /**
     * Set type of sorting by UUID. Default is null (not sorting). 
     * 
     * @param string $type Type of sorting. Accept only ASC or DESC.
     * 
     * @return self
     */
    public function setSortUUID(string $type): self
    {
        if (!$this->isValidSortType($type)) {
            return $this;
        }

        $this->sortUUID = $type;
     
        return $this;
    }
    /**
     * Set type of sorting by Status. Default is null (not sorting). 
     * 
     * @param string $type Type of sorting. Accept only ASC or DESC.
     * 
     * @return self
     */
    public function setSortStatus(string $type): self
    {
        if (!$this->isValidSortType($type)) {
            return $this;
        }

        $this->sortStatus = $type;
        return $this;
    }

     /**
     * Set type of sorting by Shipping. Default is null (not sorting). 
     * 
     * @param string $type Type of sorting. Accept only ASC or DESC.
     * 
     * @return self
     */
    public function setSortShipping(string $type): self
    {
        if (!$this->isValidSortType($type)) {
            return $this;
        }

        $this->sortShipping = $type;
        return $this;
    }

    /**
     * Set type of sorting by Shipment. Default is null (not sorting). 
     * 
     * @param string $type Type of sorting. Accept only ASC or DESC.
     * 
     * @return self
     */
    public function setSortShipment(string $type): self
    {
        if (!$this->isValidSortType($type)) {
            return $this;
        }

        $this->sortShipment = $type;
        return $this;
    }

    /**
     * Set type of sorting by Payment. Default is null (not sorting). 
     * 
     * @param string $type Type of sorting. Accept only ASC or DESC.
     * 
     * @return self
     */
    public function setSortPayment(string $type): self
    {
        if (!$this->isValidSortType($type)) {
            return $this;
        }

        $this->sortPayment = $type;
        return $this;
    }

    /**
     * Set type of sorting by ClientID. Default is null (not sorting). 
     * 
     * @param string $type Type of sorting. Accept only ASC or DESC.
     * 
     * @return self
     */
    public function setSortClientID(string $type): self
    {
        if (!$this->isValidSortType($type)) {
            return $this;
        }

        $this->sortClientID = $type;
        return $this;
    }

    /**
     * Set type of sorting by Date. Default is null (not sorting). 
     * 
     * @param string $type Type of sorting. Accept only ASC or DESC.
     * 
     * @return self
     */
    public function setSortDate(string $type): self
    {
        if (!$this->isValidSortType($type)) {
            return $this;
        }

        $this->sortDate = $type;
        return $this;
    }
}
