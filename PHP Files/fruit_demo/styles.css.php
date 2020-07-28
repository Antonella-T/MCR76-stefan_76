<?php
  $myRoot = substr($_SERVER['DOCUMENT_ROOT'], 0, strpos($_SERVER['DOCUMENT_ROOT'], 'public_html'));
  $myPage = $_SERVER['PHP_SELF'];
  require  $myRoot . 'mcr76_hidden/script.php';
  header('Content-Type: text/css');
?>
/* CSS File Rev 0.1 */

body {
  background-color: #cccccc;
}

#ngReadAutoContainer {
  border: 1px solid black;
  padding: 0;
}

#ngReadAutoContainer ul {
  padding: 0;
  margin: 0;
}

#ngReadAutoContainer li {
  border: 1px solid gray;
  margin: 0;
  list-style: none;
  cursor: pointer;
}

#ngReadAutoContainer li:hover {
  background-color: gray;
}
