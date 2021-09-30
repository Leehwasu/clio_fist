<?php
include $_SERVER['DOCUMENT_ROOT'].'/user/service/query.php';

function user_list(){
    $data['user_list'] = getUserList();
    return $data;
}
function user_list_oci(){
    $data['user_list'] = getUserList_OCI();
    return $data;
}

?>