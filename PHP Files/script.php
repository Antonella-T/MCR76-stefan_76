<?php
  if (strpos($myPage, '/index.php')) {echo '<script>console.log(\'My IP: ' . getClientIp() . '\');</script>';}
  $configJson = file_get_contents($myRoot . 'mcr76_hidden/config.json');
  $config = json_decode($configJson, true);

  if (getClientIp() == $config['myIp'] || getClientIp() == $config['stefansIp']) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if (strpos($myPage, '/index.php') || strpos($myPage, '.htm')) {
      if (strpos($myPage, '/index.php')) {
        echo '<script>console.log(\'My Root: ' . $myRoot . '\');</script>';
        echo '<script>console.log(\'script.php Rev 0.2\');</script>';
        //date_default_timezone_set('Europe/Dublin');
        $timeStamp = time();
        $loadDate = date('d.m.Y', $timeStamp);
        $loadTime = date('H:i:s', $timeStamp);
        echo '<script>console.log(\'Server Time: ' . $loadTime . ' ' . $loadDate . '\');</script>';
        echo '<script>console.log(\'' . $myPage . ' loaded [HOME]\');</script>';
      }
      else {
        echo '<script>console.log(\'' . $myPage . ' loaded [HTML]\');</script>';
      }
      $conn = mysqli_connect($config['dbServer'], $config['dbUserName'], $config['dbPassWord']);
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      echo '<script>console.log(\'Connected to DB successfully [DB]\');</script>';
      $conn->close();
    } 
    else if (strpos($myPage, '.js.')) {
      echo 'console.log(\'' . $myPage . ' loaded [JS]\');';
    }
    else if (strpos($myPage, '.css.')) {
      echo '/* ' . $myPage . ' loaded [CSS] */';
      //echo '\r\n';
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
