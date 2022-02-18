<?php

$response->setHeader('Content-Type', $mime);
$response->setHeader('Content-Disposition', 'attachment; filename="orders.'.$method.'"');
${($method ?? 'xlsx') . 'Writer'}->save("php://output");
