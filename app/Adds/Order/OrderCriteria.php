<?php

namespace App\Adds\Order;

class OrderCriteria
{
  private $uuid = null;
  private $status = null;
  private $shippingTotal = null;
  private $shipment = null;
  private $payment = null;
  private $client_id = null;
  private $date = null;

  public function getUUID()
  {
    return $this->uuid;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function getShippingTotal()
  {
    return $this->shippingTotal;
  }

  public function getShipment()
  {
    return $this->shipment;
  }

  public function setUUID(string $uuid = null): void
  {
    $this->uuid = $uuid;
  }

  public function setStatus(string $status = null): void
  {
    $this->status = $status;
  }

  public function setShippingTotal(string $shippingTotal = null): void
  {
    $this->shippingTotal = $shippingTotal;
  }

  public function setShipment(string $shipment): void
  {
    $this->shipment = $shipment;
  }
}
