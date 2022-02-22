<?php

namespace App\Adds\Order;

/**
 * Basic class that allows to manage order struct.
 */
class OrderCriteria
{
    /**
     * String contains search phrase for UUID. Default is null
     * 
     * @var string|null
     */
    private $UUID = null;
    /**
     * String contains search phrase for UUID. Default is null
     * 
     * @var null
     */
    private $Status = null;
    /**
     * String contains search phrase for Status. Default is null
     * 
     * @var null
     */
    private $Shipping = null;
    /**
     * String contains search phrase for Shipment. Default is null
     * 
     * @var null
     */
    private $Shipment = null;
    /**
     * String contains search phrase for Payment. Default is null
     * 
     * @var null
     */
    private $Payment = null;
    /**
     * String contains search phrase for ClientID. Default is null
     * 
     * @var null
     */
    private $ClientID = null;
    /**
     * String contains search phrase for Date. Default is null
     * 
     * @var null
     */
    private $Date = null;

    /**
     * If UUID phrase is set return search phrase. Null otherwise.
     * 
     * @return string
     */
    public function getUUID(): string|null
    {
        return $this->UUID;
    }

    /**
     * If Status phrase is set return search phrase. Null otherwise.
     * 
     * @return string
     */
    public function getStatus(): string|null
    {
        return $this->Status;
    }

    /**
     * If Shipping phrase is set return search phrase. Null otherwise.
     * 
     * @return string
     */
    public function getShipping(): string|null
    {
        return $this->Shipping;
    }

    /**
     * If Shipment phrase is set return search phrase. Null otherwise.
     * 
     * @return string
     */
    public function getShipment(): string|null
    {
        return $this->Shipment;
    }

    /**
     * If Payment phrase is set return search phrase. Null otherwise.
     * 
     * @return string
     */
    public function getPayment(): string|null
    {
        return $this->Payment;
    }

    /**
     * If ClientID phrase is set return search phrase. Null otherwise.
     * 
     * @return string
     */
    public function getClientID(): string|null
    {
        return $this->ClientID;
    }

    /**
     * If Date phrase is set return search phrase. Null otherwise.
     * 
     * @return string
     */
    public function getDate(): string|null
    {
        return $this->Date;
    }

    /**
     * Set the UUID search phrase
     * 
     * @param string $UUID String contains Status search phrase
     * 
     * @return self
     */
    public function setUUID(string $UUID): self
    {
        $this->UUID = $UUID;
        
        return $this;
    }

    /**
     * Set the Status search phrase
     * 
     * @param string $Status String contains Status search phrase
     * 
     * @return self
     */
    public function setStatus(string $Status): self
    {
        $this->Status = $Status;
        
        return $this;
    }

    /**
     * Set the Shipping search phrase
     * 
     * @param string $Shipping String contains Shipping search phrase
     * 
     * @return self
     */
    public function setShipping(string $Shipping): self
    {
        $this->Shipping = (float) $Shipping;
        
        return $this;
    }

    /**
     * Set the Shipment search phrase
     * 
     * @param string $Shipment String contains Shipment search phrase
     * 
     * @return self
     */
    public function setShipment(string $Shipment): self
    {
        $this->Shipment = $Shipment;
        
        return $this;
    }

    /**
     * Set the Payment search phrase
     * 
     * @param string $Payment String contains Payment search phrase.
     * 
     * @return self
     */
    public function setPayment(string $Payment): self
    {
        $this->Payment = $Payment;
        
        return $this;
    }

    /**
     * Set the ClientID search phrase
     * 
     * @param string $ClientID String contains ClientID search phrase.
     * 
     * @return self
     */
    public function setClientID(string $ClientID): self
    {
        $this->ClientID = $ClientID;
        
        return $this;
    }

    /**
     * Set the Date search phrase
     * 
     * @param string $Date String contains Date search prase.
     * 
     * @return self
     */
    public function setDate(string $Date): self
    {
        $this->Date = $Date;
        
        return $this;
    }

    /**
     * Check property exists in Criteria.
     * 
     * @param string $property Name of property that have to checked.
     * 
     * @return bool
     */
    public function exists(string $property): bool {
        return property_exists(new static, $property);
    }
}
