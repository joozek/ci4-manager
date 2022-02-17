<?php

namespace App\Adds\Order;

class OrderSearchCriteria extends OrderCriteria
{
  private $sortUUID = null;
  private $sortStatus = null;
  private $sortShippingTotal = null;
  private $sortShipment = null;

  private function isValidSortType(string $type = null)
  {
    if ($type !== 'ASC' && $type !== 'DESC') {
      return FALSE;
    }

    return TRUE;
  }

  public function getSortUUID()
  {
    return $this->sortUUID;
  }

  public function getSortStatus()
  {
    return $this->sortStatus;
  }

  public function getSortShippingTotal()
  {
    return $this->sortShippingTotal;
  }

  public function getSortShipment()
  {
    return $this->sortShipment;
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

  public function setSortShippingTotal(string $shippingTotal = null): void
  {
    if (!$this->isValidSortType($shippingTotal)) {
      return;
    }

    $this->sortShippingTotal = $shippingTotal;
  }

  public function setSortShipment(string $shipment = null): void
  {
    if (!$this->isValidSortType($shipment)) {
      return;
    }
    $this->sortShipment = $shipment;
  }
}
