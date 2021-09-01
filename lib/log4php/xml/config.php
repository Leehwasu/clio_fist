<?php 
return array(
    'rootLogger' => array(
        'appenders' => array('default'),
    ),
    'appenders' => array(
        'default' => array(
            'class' => 'LoggerAppenderDailyFile',
            'layout' => array(
                'class' => 'LoggerLayoutPattern',
            ),
            'params' => array(
                'file' => 'D:\log\clio_fist/log_'.date('Ymd').'.log',
            	'append' => true
            )
        )
    )
);
?>