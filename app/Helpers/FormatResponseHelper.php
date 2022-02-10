<?php

function separateOrdersAndProducts($response)
{
    if (!is_array($response)) {
        throw new \Exception('Response must be an array.');
    }
}
