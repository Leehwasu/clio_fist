<?php
// 세션 세팅
session_start();

// 불러올 파일
include 'config.php';
include 'db.php';
include $_SERVER["DOCUMENT_ROOT"].'/lib/log4php/Logger.php';

// Log4php 세팅
global $logger;
$logger = Logger::getLogger(SERVICE_NAME);
Logger::configure($_SERVER["DOCUMENT_ROOT"]. '/lib/log4php/xml/config.php');

// DB 커낵션 및 DB관련 함수
function db_open(){
    global $db_conn;
    $db_conn = mysqli_connect(MYSQL_HOST, MYSQL_ID, MYSQL_PW, MYSQL_DB);
}
db_open();

// DB 커낵션 및 DB관련 함수
function db_open_oci(){
    global $db_conn_oci;
    $dbsid = "(
      DESCRIPTION =
      (ADDRESS_LIST =
       (ADDRESS =
        (PROTOCOL = TCP)
        (HOST = localhost)
        (PORT = 1521)
       )
      )
            
      (CONNECT_DATA =
       (SERVER = ORCL)
       (SERVICE_NAME = ORCL)
      )
    ) ";
        
    $db_conn_oci = oci_connect(OCI_ID, OCI_PW, $dbsid, 'AL32UTF8');
}
db_open_oci();

function selectList($query){
    global $logger;
    global $db_conn;
    $logger->info("[{$_SERVER['REMOTE_ADDR']}] ".$_SERVER['HTTP_HOST']." | ". "({$_SESSION['user_name']}) " . "({$_SESSION['user_id']}) ".$query);
    
    $result = mysqli_query($db_conn, $query);
    
    if (!$result) {
        $logger->error("[{$_SERVER['REMOTE_ADDR']}] ".$_SERVER['HTTP_HOST']." | ". "({$_SESSION['user_name']}) " . "({$_SESSION['user_id']}) ". mysqli_error($db_conn));
        exit;
    }else{
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    return $data;
}
function selectList_OCI($query){
    global $logger;
    global $db_conn_oci;
    $logger->info("[{$_SERVER['REMOTE_ADDR']}] ".$_SERVER['HTTP_HOST']." | ". "({$_SESSION['user_name']}) " . "({$_SESSION['user_id']}) ".$query);
    
    $result = oci_parse($db_conn_oci, $query);
    oci_execute($result);
    
    if (!$result) {
        $logger->error("[{$_SERVER['REMOTE_ADDR']}] ".$_SERVER['HTTP_HOST']." | ". "({$_SESSION['user_name']}) " . "({$_SESSION['user_id']}) ". mysqli_error($db_conn));
        exit;
    }else{
        while ($row = oci_fetch_array($result, OCI_ASSOC)) {
            $data[] = $row;
        }
    }
    return $data;
}
?>