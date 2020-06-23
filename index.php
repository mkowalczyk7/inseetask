<?php
include('app/config/config.php');

use App\Controller\Service;

/**
 * Let's the magic begin
 */
$service = new Service();
$service->getSha();
