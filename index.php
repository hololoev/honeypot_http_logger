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

include 'honey_libs/honey_conf.php';
include 'honey_libs/logger.php';

$info = getRequestInfo();
$info['scan_type'] = getScanType($info);
saveLog($info, getConfig()['mysql'] );
?>
