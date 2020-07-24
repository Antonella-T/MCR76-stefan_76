<?php
  $myRoot = substr($_SERVER['DOCUMENT_ROOT'], 0, strpos($_SERVER['DOCUMENT_ROOT'], 'public_html'));
  $myPage = $_SERVER['PHP_SELF'];
  require  $myRoot . 'mcr76_hidden/script.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>MCR76 - Fruit DB</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.js"></script> 
  <script src="scripts/scripts.js.php"></script>  
</head>
<body>
  <div class="wrapper"></div>
    <h1>Welcome to Fruit DB Page</h1>
    
    <button id="createDbTable">Create DB Table</button>
    <button id="removeDbTable">Remove DB Table</button><br>    
    
  </div><!-- wrapper end -->
</body>
