<?php 

function getRequestInfo() {
  $info = [
    'addr' => $_SERVER['REMOTE_ADDR'],
    'port' => 80,
    'proto' => 'http',
    'req_time' => time(),
    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
    'url' => $_SERVER['REQUEST_URI'],
    'http_method' => $_SERVER['REQUEST_METHOD']
  ];

  if( count($_POST) > 0 )
    $info['post_fields'] = $_POST;

  return $info;
}

function isWhitleListed($addr, $whiteList) {
  return array_search($addr, $whiteList);
}

function getScanType($info) {
  $upperUrl = strtoupper($info['url']);

  if( strrpos($upperUrl, 'MYADMIN') !== false )
    return 'phpMyadmin';

  if( strrpos($upperUrl, 'WP-') !== false )
    return 'wordpress';

  return 'unknown';
}

function saveLog($info, $mysqlConf) {
  if( strlen($info['url']) > 255 )
    $info['url'] = substr($info['url'], 0, 256);

  if( strlen($info['user_agent']) > 128 )
    $info['user_agent'] = substr($info['user_agent'], 0, 128);

  $mysqli = new mysqli($mysqlConf['addr'], $mysqlConf['user'], $mysqlConf['pass'], $mysqlConf['dbName']);

  $tableKeys = [];
  foreach($info as $key => $val)
    $tableKeys[] = "`$key`";

  $values = [];
  foreach($info as $key => $val) {
    if( gettype($val) == 'integer' )
      $values[] = $val;
    else
      $values[] = "'" . htmlspecialchars($val, ENT_QUOTES). "'";
  }

  $query = 'INSERT INTO access_logs (' . implode(', ', $tableKeys) . ') VALUES (' . implode(', ', $values) . ');';

  $mysqli->query($query);

  $mysqli->close();
}

?>