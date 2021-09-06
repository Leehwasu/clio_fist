<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
header("Content-Type:text/html;charset=utf-8");

include '../common/common.php';
include 'service/service.php';

$data = user_list_oci();

print_r($data);
?>