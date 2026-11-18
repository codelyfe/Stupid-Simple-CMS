<?php
require_once __DIR__ . '/../includes/store.php';
header('Content-Type: application/json');
echo json_encode(site_settings());
