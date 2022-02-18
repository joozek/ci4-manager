<?php

$response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
$response->setHeader('Content-Disposition', 'attachment; filename="orders.docx"');
$writer->save('php://output');