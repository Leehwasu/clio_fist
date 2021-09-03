<?php
include $_SERVER['DOCUMENT_ROOT'].'/user/service/query.php';

function user_list(){
    $data['user_list'] = getUserList();
    return $data;
}

?>