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
?>