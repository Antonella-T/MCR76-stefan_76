<?php
  $myRoot = substr($_SERVER['DOCUMENT_ROOT'], 0, strpos($_SERVER['DOCUMENT_ROOT'], 'public_html'));
  $myPage = $_SERVER['PHP_SELF'];
  require  $myRoot . 'mcr76_hidden/script.php';
?>
console.log('Hello World!');
