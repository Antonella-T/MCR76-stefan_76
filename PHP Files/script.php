<?php
  if (strpos($myPage, '/index.php')) {echo '<script>console.log(\'My IP: ' . getClientIp() . '\');</script>';}
  $configJson = file_get_contents($myRoot . 'mcr76_hidden/config.json');
  $config = json_decode($configJson, true);

  if (getClientIp() == $config['myIp'] || getClientIp() == $config['stefansIp']) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if (strpos($myPage, '/index.php')) {
      echo '<script>console.log(\'My Root: ' . $myRoot . '\');</script>';
      echo '<script>console.log(\'' . $myPage . ' loaded [HOME]\');</script>';
      $conn = mysqli_connect($config['dbServer'], $config['dbUserName'], $config['dbPassWord']);
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      echo '<script>console.log(\'Connected to DB successfully [DB]\');</script>';
    }
    else if (strpos($myPage, '/.htm')) {
      echo '<script>console.log(\'' . $myPage . ' loaded [HTML]\');</script>';
    }
    else if (strpos($myPage, '.js.')) {
      echo 'console.log(\'' . $myPage . ' loaded [JS]\');';
    }
  }
  else {
    echo '<script>console.log(\'Authorization Required ...\');</script>';
    exit;
  }






  function getClientIp() {
    $ipAddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
      $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
      $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
      $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
      $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
      $ipAddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
      $ipAddress = $_SERVER['REMOTE_ADDR'];
    else
      $ipAddress = 'UNKNOWN';
    return $ipAddress; 
  }
?>
