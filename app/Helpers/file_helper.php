<?php

function getMime(string $method = null): string
{
    if ($method === 'csv') {
        return 'text/csv';
    }

    return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
}
