<!DOCTYPE html>
<html>
<head>
<title>Under construction.</title>
<style>
    html {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: Tahoma, Verdana, Arial, sans-serif;
        background-image: url('/img/back.jpg');
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }
    .content {
        margin: 0;
        padding-top: 10%;
        max-width: 100%;
        text-align: center;
    }
    h1 {
        font-size: 50px;
    }
</style>
</head>
<body>
    <div class="content">
        <h1>This website is under construction.</h1>
    </div>
</body>
</html>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'honey_libs/honey_conf.php';
include 'honey_libs/logger.php';

$config = getConfig();
$info = getRequestInfo();

if( !isWhitleListed($info['addr'], $config['excludeAddrs']) ) {
    $info['scan_type'] = getScanType($info);
    $info['source'] = $config['nodeName'];
    saveLog($info, $config['mysql'] );
}
?>
