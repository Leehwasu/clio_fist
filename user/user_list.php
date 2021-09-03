<?php
include '../common/common.php';
include 'service/service.php';

$data = user_list();

print_r($data);
?>