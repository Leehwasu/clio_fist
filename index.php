<?php 
include('./lib/log4php/Logger.php');
Logger::configure('./lib/log4php/xml/config.php');
$logger = Logger::getLogger("");
$logger->info("This is an informational message.");
$logger->warn("I'm not feeling so good...");
session_start();
$_SESSION['user_id'] = "yoonchul";
$query = "select 
*
from
 hahaha
";
$logger->info("[{$_SERVER['REMOTE_ADDR']}] ".$_SERVER['HTTP_HOST']." | " . "({$_SESSION['user_id']}) ".$query);
?>