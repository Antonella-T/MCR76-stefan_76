<?php
/*
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+                                                                              +
+  This php file is part of our backend processing.                            +
+  PHP scripting not covered in the Front End Web Developer Course             +
+                                                                              +
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/

  $myRoot = substr($_SERVER['DOCUMENT_ROOT'], 0, strpos($_SERVER['DOCUMENT_ROOT'], 'public_html'));
  $myPage = $_SERVER['PHP_SELF'];
  require  $myRoot . 'mcr76_hidden/script.php';
  
  $data = json_decode($_POST['data'], true);
  $tableName = array_keys($data)[0];

if ($config['myRoot'] != '/home/' . $data[$tableName]['apiKey'] . '/') {
  echo 'Authorization Required ...';
  exit;
}

  $timeZone = $data[$tableName]['timeZone'];
  //echo $timeZone;
  $debugD = '';
  $dbPhpRev = '0.3';
  $strOrig = array('"');
  $strEsc = array('\"');
  $aok = false;
  
if ($data[$tableName]['purpose'] == 'CT') {
  //echo 'Create Table';
  $conn = connectDb();
  $sql = 'CREATE TABLE ' . $tableName . ' (';
  $sql .= 'id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,';
  //echo sizeof($data[$tableName]['data']);
  //print_r($data[$tableName]['data'][1]);
  //$rows = json_decode($data[$tableName]['data'], true);
  //echo $rows;
  foreach($data[$tableName]['data'] as $x) {
    $sql .= ' ' . $x['colName'];
    if ($x['dataType'] == 'String') {
      $sql .= ' VARCHAR(' . $x['dataLength'] . ') CHARACTER SET utf8 COLLATE utf8_unicode_ci';
    }
    if ($x['dataType'] == 'Number') {
      $sql .= ' DECIMAL (14,5)';
    }
    if ($x['dataType'] == 'Boolean') {
      $sql .= ' BOOLEAN';
    }
    if ($x['unique'] == 1) {
      $sql .= ' NOT NULL UNIQUE';
    }
    $sql .= ', ';
    //for($x = 0; $x <= sizeof($data[$tableName]['data']); $x++) {
    //echo $x;
    //echo $x['colName'];
    //echo $data[$tableName]['data'][$x]['colName'];
  }
  $sql .= 'createDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP, ';
  $sql .= 'updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)';
  if ($conn->query($sql) === TRUE) {
    $debugD .= 'Table ' . $tableName . ' created successfully. ';
    $aok = true;
  } else {
    $debugD .= 'Error creating table' . $tableName . ': ' . $conn->error . '. ';
    //$aok = false;
  }
  returnJson('{}', 0, $debugD, $sql);
  $conn->close();
}
  
  
  
else if ($data[$tableName]['purpose'] == 'RT') {
  //echo 'Remove Table';
  $conn = connectDb();
  $sql = 'DROP TABLE ' . $tableName;
  if ($conn->query($sql) === TRUE) {
    $debugD .= 'Table ' . $tableName . ' removed successfully. ';
    $aok = true;
  } else {
    $debugD .= 'Error removing table' . $tableName . ': ' . $conn->error . '. ';
    //$aok = false;
  }
  returnJson('{}', 0, $debugD, $sql);
  $conn->close();
}
  
  
else if ($data[$tableName]['purpose'] == 'AC') {
  //echo 'Add Column(s)';
  $conn = connectDb();

    $sql = 'ALTER TABLE ' . $tableName;
foreach($data[$tableName]['data'] as $x) {
  $sql .= ' ADD COLUMN ' . $x['colName'];
  if ($x['dataType'] == 'String') {
    $sql .= ' VARCHAR(' . $x['dataLength'] . ') CHARACTER SET utf8 COLLATE utf8_unicode_ci';
  }
  if ($x['dataType'] == 'Number') {
    $sql .= ' DECIMAL (14,5)';
  }
  if ($x['dataType'] == 'Boolean') {
    $sql .= ' BOOLEAN';
  }
  if ($x['unique'] == 1) {
    $sql .= ' NOT NULL UNIQUE';
  }
  $sql .= ', ';
}

$sql = substr($sql, 0, -2);

echo $sql . '<br><br><br>';  
    
    
if ($conn->query($sql) === TRUE) {
  echo 'Table ' . $tableName . ' added column(s) successfully';
} else {
  echo 'Error adding column(s): ' . $conn->error;
}

$conn->close();
  }  
  
  
  


else if ($data[$tableName]['purpose'] == 'RC') {
  echo 'Remove Column(s)';
  $conn = connectDb();

    $sql = 'ALTER TABLE ' . $tableName;
foreach($data[$tableName]['data'] as $x) {
  $sql .= ' DROP COLUMN ' . $x['colName'] . ', ';
}

$sql = substr($sql, 0, -2);

echo $sql . '<br><br><br>';  
    
    
if ($conn->query($sql) === TRUE) {
  echo 'Table ' . $tableName . ' removed column(s) successfully';
} else {
  echo 'Error removing column(s): ' . $conn->error;
}

$conn->close();
  }  
  
  





else if ($data[$tableName]['purpose'] == 'ID') {
  //echo 'Import JSON Data File';
  $conn = connectDb();
      
  $jsonFile = file_get_contents($myRoot . 'mcr76_hidden/' . $tableName . '.json');
  $jsonFile = mb_convert_encoding($jsonFile, 'UTF-8', mb_detect_encoding($jsonFile, 'UTF-8, ISO-8859-1', true));
  $jsonData = json_decode($jsonFile, true);
  
  //echo $jsonData[$tableName][0]['PartNo'].  '<br>';
  //echo $jsonData[$tableName][0].  '<br>';
  //print_r($jsonData[$tableName][6]);
  //echo sizeof($jsonData[$tableName][0]) . '<br>';
  $keys = array_keys($jsonData[$tableName][0]);
  //print_r($keys);
  //var_dump(array_keys($jsonData[$tableName][0]));
  //echo ' <br>';
  //exit;

  //print_r($jsonData);  
$before = array('"');
$after = array('\"');
//$before = array();
//$after = array();
foreach($jsonData[$tableName] as $row) {
//echo $row['PartNo'];
$sql = 'INSERT INTO ' . $tableName . ' (';
foreach($keys as $key) {
$sql .= $key . ', ';    
}
$sql = substr($sql, 0, -2);
$sql .= ') VALUES ('; 
foreach($keys as $key) {
  if (gettype($row[$key]) == 'boolean' && $row[$key] == 1) {
    $sql .= '1, '; 
  }
  else if (gettype($row[$key]) == 'boolean') {
    $sql .= '0, '; 
  }
  else if (gettype($row[$key]) == 'string') {
    //$sql .= '"' . str_replace($before, $after, $row[$key]) . '", ';
    $abc = mb_convert_encoding($row[$key], 'UTF-8', mb_detect_encoding($row[$key], 'UTF-8, ISO-8859-1', true));
    $sql .= '"' . str_replace($before, $after, $abc) . '", ';
  }
  else if (gettype($row[$key]) == 'integer' || gettype($row[$key]) == 'double') {
    $sql .= str_replace($before, $after, $row[$key]) . ', ';
  }
  else {
    $sql .= '"' . str_replace($before, $after, $row[$key]) . '", ';
    //echo gettype($row[$key]) . ' ... ' . $row[$key] . ' ... ';
  }
}
$sql = substr($sql, 0, -2);
$sql .= ')'; 


if ($conn->query($sql) === TRUE) {
  //echo 'Table ' . $tableName . ' imported JSON data successfully';
} else {
    echo '>>>' . $sql . '<<<';
  echo 'Error importing JSON data: ' . $conn->error;
}

//echo '<br>';echo '<br>';
//echo $sql;

  //exit;
    
    
}
$conn->close();
  }  
  
  

else if ($data[$tableName]['purpose'] == 'ED') {
  //echo 'Export JSON Data File';
  $conn = connectDb();
  $sql = 'SELECT * FROM ' . $tableName;
  $result = mysqli_query($conn, $sql);
  $fieldCount = $result->field_count;
  //echo $fieldCount;
  for($x = 0; $x < $fieldCount; $x++) {
    $finfo = $result->fetch_field_direct($x);
    $dbCols[] = $finfo->name;
    $dbType[] = $finfo->type;
  }
  //while($mysql_query_fields = mysqli_fetch_field($result)){
    //$dbCols[] = $mysql_query_fields->name;
    //echo ucfirst($mysql_query_fields->name);
  //}
  //print_r($dbCols);
  $before = array('"');
  $after = array('\"');
  $jsonStr = '{"' . $tableName . '": [';
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $jsonStr .= '{';
        for($x = 0; $x < sizeof($dbCols); $x++) {
          $jsonStr .= '"' . $dbCols[$x] . '": ';
          if ($dbType[$x] == 253) {
            //echo 'String Data Type'; // OK
            $jsonStr .= '"' . str_replace($before, $after, $row[$dbCols[$x]]) . '"';
          }
          else if ($dbType[$x] == 3 || $dbType[$x] == 246 || $dbType[$x] == 4 || $dbType[$x] == 5) {
            //echo 'Number Data Type (JS Exercise)'; // OK
            $jsonStr .= $row[$dbCols[$x]];
          }
          else if ($dbType[$x] == 7 || $dbType[$x] == 10 || $dbType[$x] == 12 || $dbType[$x] == 14) {
            //echo 'DateTime Data Type';
            $jsonStr .= '"' . $row[$dbCols[$x]] . '"';
          }
          else if ($dbType[$x] == 1 || $dbType[$x] == 254) {
            //echo 'Boolean Data Type'; // OK
            if ($row[$dbCols[$x]] == 1) {
              $jsonStr .= 'true';    
            }
            else {
              $jsonStr .= 'false';    
            }
          }
          else {
            //echo 'as String Data Type';
            $jsonStr .= '"?' . $row[$dbCols[$x]] . ' [' . $dbType[$x] . ']?"';
          }
          $jsonStr .= ', ';
        }
      $jsonStr = substr($jsonStr, 0, -2);
      $jsonStr .= '}, ';
    }
  }  
  else {
    echo "0 results";
  }
  $jsonStr = substr($jsonStr, 0, -2);
  $jsonStr .= ']}';
  //echo $jsonStr;
  date_default_timezone_set($timeZone);
  $timeStamp = time();
  $saveTime = date('_YmdHis', $timeStamp);
  file_put_contents($myRoot . 'mcr76_hidden/' . $tableName . $saveTime . '.json', $jsonStr);
}


else if ($data[$tableName]['purpose'] == 'C') {
  //echo 'Create Records';
  $conn = connectDb();
  $sql = 'INSERT INTO ' . $tableName .' (';
  //print_r($data[$tableName]);
  foreach($data[$tableName]['data'] as $x) {
    $sql .= $x['colName'] . ', ';
  }
  $sql = substr($sql, 0, -2);
  $sql .= ') VALUES (';
  foreach($data[$tableName]['data'] as $x) {
    if ($x['dataType'] == 'String') {
      $sql .= '"' . $x['new'] . '", ';        
    }
    else if ($x['dataType'] == 'Number') {
      $sql .= $x['new'] . ', ';        
    }
    else if ($x['dataType'] == 'Boolean') {
      if ($x['new'] == 1) {
        $sql .= '1, ';    
      }
      else {
        $sql .= '0, ';    
      }
    }
    else {
      $sql .= '"' . $x['new'] . '", ';        
    }
  }
  $sql = substr($sql, 0, -2);
  $sql .= ')';
  //echo $sql;
  //exit;
  if ($conn->query($sql) === TRUE) {
    $debugD .= 'Created new record for ' . $tableName . ' successfully. ';
    $aok = true;
  } else {
    $debugD .= 'Error creating new record for ' . $tableName . ': ' . $conn->error . '. ';
    //$aok = false;
  }
  returnJson('{}', 0, $debugD, $sql);
  $conn->close();
}  


else if ($data[$tableName]['purpose'] == 'R') {
  //echo 'Read Records';
  $conn = connectDb();
  $sql = 'SELECT * FROM ' . $tableName;
  $sql .= sqlWhereAnd($data[$tableName]);
  if ($data[$tableName]['sort'] != 'n/a') {
    $sql .= ' ORDER BY ' . $data[$tableName]['sort']; 
  }
  if ($data[$tableName]['pageSize'] >= 0) {
    $sql .= ' LIMIT ' . $data[$tableName]['pageSize'];
    if ($data[$tableName]['startVal'] >= 0) {
      $sql .= ' OFFSET ' . $data[$tableName]['startVal']; 
    }
  }
  //echo $sql;
  //exit;

  $result = mysqli_query($conn, $sql);
  $fieldNames = getFieldNames($result);
  $dbCols = $fieldNames['dbCols'];
  $dbType = $fieldNames['dbType'];
  $jsonStr = '{"' . $tableName . '": [';
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $jsonStr .= '{';
        for($x = 0; $x < sizeof($dbCols); $x++) {
          $jsonStr .= '"' . $dbCols[$x] . '": ';
          if ($dbType[$x] == 253) {
            //echo 'String Data Type'; // OK
            $jsonStr .= '"' . str_replace($strOrig, $strEsc, $row[$dbCols[$x]]) . '"';
          }
          else if ($dbType[$x] == 3 || $dbType[$x] == 246 || $dbType[$x] == 4 || $dbType[$x] == 5) {
            //echo 'Number Data Type (JS Exercise)'; // OK
            $jsonStr .= $row[$dbCols[$x]];
          }
          else if ($dbType[$x] == 7 || $dbType[$x] == 10 || $dbType[$x] == 12 || $dbType[$x] == 14) {
            //echo 'DateTime Data Type';
            $jsonStr .= '"' . $row[$dbCols[$x]] . '"';
          }
          else if ($dbType[$x] == 1 || $dbType[$x] == 254) {
            //echo 'Boolean Data Type'; // OK
            if ($row[$dbCols[$x]] == 1) {
              $jsonStr .= 'true';    
            }
            else {
              $jsonStr .= 'false';    
            }
          }
          else {
            //echo 'as String Data Type';
            $jsonStr .= '"?' . $row[$dbCols[$x]] . ' [' . $dbType[$x] . ']?"';
          }
          $jsonStr .= ', ';
        }
      $jsonStr = substr($jsonStr, 0, -2);
      $jsonStr .= '}, ';
    }
    $jsonStr = substr($jsonStr, 0, -2);
    $debugD .= "Found matching results. ";
    $aok = true;
  }  
  else {
    $aok = true;
    $debugD .= "No matching results. ";
  }
  $jsonStr .= ']}';
  returnJson($jsonStr, mysqli_num_rows($result), $debugD, $sql);
  $conn->close();
}  


else if ($data[$tableName]['purpose'] == 'D') {
  //echo 'Delete Records';
  $conn = connectDb();
  //"DELETE FROM MyGuests WHERE id=3";
  $sql = 'DELETE FROM ' . $tableName;
  $sql .= sqlWhereAnd($data[$tableName]);
  //echo $sql;
  //exit;
  if ($conn->query($sql) === TRUE) {
    $debugD .= 'Deleted record(s) from ' . $tableName . ' successfully. ';
    $aok = true;
  } else {
    $debugD .= 'Error deleting record(s) from ' . $tableName . ': ' . $conn->error . '. ';
    //$aok = false;
  }
  returnJson('{}', 0, $debugD, $sql);
  $conn->close();
}  


else {
  returnJson('{}', 0, 'Nothing to do ... :', 'n/a');
}

// FUNCTIONS:
// ==========
function getFieldNames($result) {
  $fieldCount = $result->field_count;
  for($x = 0; $x < $fieldCount; $x++) {
    $finfo = $result->fetch_field_direct($x);
    $dbCols[] = $finfo->name;
    $dbType[] = $finfo->type;
  }
  return array('dbCols'=>$dbCols, 'dbType'=>$dbType);
}

function sqlWhereAnd($data) {
  //print_r($data['data']);
  $sql =  ' WHERE ';
  foreach($data['data'] as $x) {
    //echo $x['colName'] . $x['search'] . $x['dataType'];
    if ($x['dataType'] == 'String') {
      if ($x['strict'] == 1) {
        $sql .= $x['colName'] . ' LIKE "' . $x['search'] . '"';
      } else {
        $sql .= $x['colName'] . ' LIKE "%' . $x['search'] . '%"';
      }
    }
    else if ($x['dataType'] == 'Number') {
      $sql .= $x['colName'] . ' = ' . $x['search'];
    }
    else if ($x['dataType'] == 'Boolean') {
      if ($x['search'] == 1) {
        $sql .= $x['colName'] . ' = 1';
      } else {
        $sql .= $x['colName'] . ' != 1';
      }
    }
    $sql .= ' AND ';
  }
  return substr($sql, 0, -5);
}

function connectDb(){
  global $config;
  $conn = mysqli_connect($config['dbServer'], $config['dbUserName'], $config['dbPassWord'], $config['dbName']);
  if (!$conn) {die("Connection failed: " . mysqli_connect_error());}
  return $conn;
}

function returnJson($jsonStr, $rows, $debugD, $sql) {
  global $aok, $data, $dbPhpRev, $strOrig, $strEsc, $tableName;
  $rtnStr = '{"aok": ';
  if ($aok == true) {
    $rtnStr .= 'true, ';
  }
  else {
    $rtnStr .= 'false, ';
  }
  if ($data[$tableName]['debug'] == 1) {
    $rtnStr .= '"sql": "' . str_replace($strOrig, $strEsc, $sql) . '", ';
    $rtnStr .= '"debug": "' . str_replace($strOrig, $strEsc, trim($debugD)) . '", ';
    $rtnStr .= '"sort": "' . $data[$tableName]['sort'] . '", ';
    $rtnStr .= '"dbPhpRev": "' . $dbPhpRev. '", ';
    date_default_timezone_set($data[$tableName]['timeZone']);
    $timeStamp = time();
    $rtnStr .= '"localTime": "' . date('H:i:s d.m.Y', $timeStamp). '", ';
  }
  $rtnStr .= '"data": ' . $jsonStr . ', ';
  $rtnStr .= '"startVal": ' . $data[$tableName]['startVal'] . ', ';
  $rtnStr .= '"pageSize": ' . $data[$tableName]['pageSize'] . ', ';
  $rtnStr .= '"rows": ' . $rows . '}';
  echo $rtnStr;
}
?>
