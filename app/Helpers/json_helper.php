<?php

function getJSON($input)
{
    $json = validateBody($input) ? \json_decode($input) : [];
    return $json;
}

function getValidJSON($input)
{
    $json = getJSON($input);
    validateJSON($json);

    return $json;
}

function validateBody($json): bool
{
    if (is_null($json) || !\json_decode($json)) {
        return FALSE;
    }

    return TRUE;
}

function isUUIDExists(object $json): void
{
    if (!property_exists($json, 'uuid')) {
        throw new \Exception('Request body does not contain a UUID. Add before next request.');
    }
}

function validateJSON(object $json): bool
{
    isUUIDExists($json);
    if (!property_exists($json, 'status')) {
        throw new \Exception('Request body does not contain a Status. Add before next request.');
    }
    if (!property_exists($json, 'client_id')) {
        throw new \Exception('Request body does not contain a ClientID. Add before next request.');
    }
    if (!property_exists($json, 'payment')) {
        throw new \Exception('Request body does not contain a Payment. Add before next request.');
    }
    if (!property_exists($json, 'shipment')) {
        throw new \Exception('Request body does not contain a Shipment. Add before next request.');
    }
    if (!property_exists($json, 'shipping_total')) {
        throw new \Exception('Request body does not contain a Shipping Total. Add before next request.');
    }

    if (!preg_match('/^[A-Z]{2}-[0-9]{3}$/', $json->client_id)) {
        throw new \Exception('Invalid ClientID format. Please check before next request.');
    }

    $valid_shipment = ['REGULAR', 'SATURDAY', 'BY_NOON'];

    if (!in_array($json->shipment, $valid_shipment)) {
        throw new \Exception('Invalid Shipment. Please check before next request.');
    }

    $valid_payment = ['CASH', 'TRANSFER'];

    if (!in_array($json->payment, $valid_payment)) {
        throw new \Exception('Invalid Payment. Please check before next request.');
    }

    if (!is_float($json->shipping_total + 0)) {
        throw new \Exception('Invalid Shipping Total. Please check before next request.');
    }

    if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/', $json->date)) {
        throw new \Exception('Invalid Date format. Plase check before next request.');
    }

    return TRUE;
}
