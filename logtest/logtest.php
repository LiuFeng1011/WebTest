<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css" />
</head>
<?php  
require_once "log.php";


//初始化日志
$logHandler= new CLogFileHandler("logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);


Log::DEBUG("DEBUG");
Log::WARN("WARN");
Log::ERROR("ERROR");
Log::INFO("INFO");
?>