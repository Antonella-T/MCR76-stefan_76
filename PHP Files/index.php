<?php

$myRoot = substr($_SERVER['DOCUMENT_ROOT'], 0, strpos($_SERVER['DOCUMENT_ROOT'], 'public_html'));
echo '<script>console.log(\'My Root: ' . $myRoot . '\');</script>';


$html ='<div id="wrapper"><h3>Test</h3></div>';

if (get_client_ip() == 'your IP address' || get_client_ip() == '46.7.62.182-') {
  echo $html;
}

//else {exit;}


// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>
