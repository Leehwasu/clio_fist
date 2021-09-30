<?php
function getUserList(){
    $query = "
        select
            *
        from
            user
    ";
    return selectList($query);
}
function getUserList_OCI(){
    $query = "
        select
            *
        from
            CLIO.USER_CLIO
    ";
    return selectList_OCI($query);
}
?>