<?php
  $myRoot = substr($_SERVER['DOCUMENT_ROOT'], 0, strpos($_SERVER['DOCUMENT_ROOT'], 'public_html'));
  $myPage = $_SERVER['PHP_SELF'];
  require  $myRoot . 'mcr76_hidden/script.php';
  header('Content-Type: application/javascript');
?>
//console.log('Hello World!');

/* purpose values for data rows: C = create, R = read, U = update, D = delete (CRUD)
   other purpose values: CT = create database table, RT = remove database table
                         AC = add col to table, RC = remove col from table, 
                         ID = import data, ED = export data
*/

var clientTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
var apiKey = 'qe3tq3y1';
$(document).ready(function(){

  $('#createDbTable').click(function() {
    console.log('createDbTable has been clicked!');
    dataString = JSON.stringify(createDbTable);
    $.post("db.php", {"data": dataString},
    function(data,status){
      console.log(data + "\nStatus: " + status);
      console.log(JSON.parse(data), "\nStatus: " + status);
    });
  }
  );

  $('#removeDbTable').click(function() {
    console.log('removeDbTable has been clicked!');
    dataString = JSON.stringify(removeDbTable);
    $.post("db.php", {"data": dataString},
    function(data,status){
      //console.log(data + "\nStatus: " + status);
      console.log(JSON.parse(data), "\nStatus: " + status);
    });
  }
  );

  $('#addTableCol').click(function() {
    console.log('addTableCol has been clicked!');
    dataString = JSON.stringify(dataAddCol);
    $.post("db.php", {"data": dataString},
    function(data,status){
      console.log(data + "\nStatus: " + status);
    });
  }
  );

  $('#removeTableCol').click(function() {
    console.log('removeTableCol has been clicked!');
    dataString = JSON.stringify(dataRemCol);
    $.post("db.php", {"data": dataString},
    function(data,status){
      console.log(data + "\nStatus: " + status);
    });
  }
  );

  $('#importData').click(function() {
    console.log('importData has been clicked!');
    dataString = JSON.stringify(dataImport);
    $.post("db.php", {"data": dataString},
    function(data,status){
      console.log(data + "\nStatus: " + status);
    });
  }
  );


  $('#exportData').click(function() {
    console.log('exportData has been clicked!');
    dataString = JSON.stringify(dataExport);
    $.post("db.php", {"data": dataString},
    function(data,status){
      console.log(data + "\nStatus: " + status);
    });
  }
  );


  $('#createRecord').click(function() {
    console.log('createRecord has been clicked!');
    dataString = JSON.stringify(createRecord());
    $.post("db.php", {"data": dataString},
    function(data,status){
      //console.log(data);
      console.log(JSON.parse(data), "\nStatus: " + status);
    });
  }
  );


  $('#readRecord').click(function() {
    console.log('readRecord has been clicked!');
    dataString = JSON.stringify(readRecord());
    $.post("db.php", {"data": dataString},
    function(data,status){
      //console.log(data);
      console.log(JSON.parse(data), "\nStatus: " + status);
    });
  }
  );

  $('#updateRecord').click(function() {
    console.log('updateRecord has been clicked!');
    dataString = JSON.stringify(updateRecord());
    $.post("db.php", {"data": dataString},
    function(data,status){
      //console.log(data);
      console.log(JSON.parse(data), "\nStatus: " + status);
    });
  }
  );

  $('#deleteRecord').click(function() {
    console.log('deleteRecord has been clicked!');
    dataString = JSON.stringify(deleteRecord());
    $.post("db.php", {"data": dataString},
    function(data,status){
      //console.log(data);
      console.log(JSON.parse(data), "\nStatus: " + status);
    });
  }
  );




});

var createDbTable = {"fruits": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "CT",
            "debug": true,
            "sort": "n/a",
            "startVal": -1,
            "pageSize": -1,
            "data": [{"colName":"fruit",
                      "unique": true,
                      "dataType":"String",
                      "dataLength": 25},
                     {"colName":"colour",
                      "unique": false,
                      "dataType":"String",
                      "dataLength": 25},
                     {"colName":"doILike",
                      "unique": false,
                      "dataType":"Boolean",
                      "dataLength": 1},
                     {"colName":"popularity",
                      "unique": false,
                      "dataType":"Number",
                      "dataLength": 0}
                    ]
           }};
           
           
var removeDbTable = {"fruits": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "RT",
            "debug": true,
            "sort": "n/a",
            "startVal": -1,
            "pageSize": -1,
            "data": [
                    ]
           }}; 


var dataAddCol = {"fruits": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "AC",
            "debug": true,
            "sort": "n/a",
            "startVal": -1,
            "pageSize": -1,
            "data": [{"colName":"texture",
                      "unique": false,
                      "dataType":"String",
                      "dataLength": 12},
                     {"colName":"juicy",
                      "unique": false,
                      "dataType":"Boolean",
                      "dataLength": 1}
                    ]
           }};           
           
           
var dataRemCol = {"fruits": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "RC",
            "debug": true,
            "sort": "n/a",
            "startVal": -1,
            "pageSize": -1,
            "data": [{"colName":"texture"},
                     {"colName":"juicy"}
                    ]
           }};           
                      

var dataImport = {"fruits": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "ID",
            "debug": true,
            "sort": "n/a",
            "startVal": -1,
            "pageSize": -1,
            "data": [{"format": "JSON"}
                    ]
           }};
           


var dataExport = {"fruits": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "ED",
            "debug": true,
            "sort": "n/a",
            "startVal": -1,
            "pageSize": -1,
            "data": [{"format": "JSON"}
                    ]
           }};
           


function createRecord() {
  return {"fruits": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "C",
            "debug": true,
            "sort": "fruit ASC",
            "startVal": -1,
            "pageSize": -1,
            "data": [{"colName": "fruit",
                      "new": $('#createFruit').val(),
                      "strict": false,
                      "dataType": "String"},
                     {"colName": "colour",
                      "new": $('#createColour').val(),
                      "strict": false,
                      "dataType": "String"},
                     {"colName": "doILike",
                      "new": $('#createDoILike').is(':checked'),
                      "strict": false,
                      "dataType": "Boolean"},
                     {"colName": "popularity",
                      "new": $('#createPopularity').val(),
                      "strict": false,
                      "dataType": "Number"}
                    ]
           }};
}


function readRecord() {
  return {"fruits": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "R",
            "debug": true,
            "sort": "fruit ASC",
            "startVal": -1,
            "pageSize": -1,
            "data": [{"colName": "fruit",
                      "search": $('#fruit').val(),
                      "strict": false,
                      "dataType": "String"},
                     {"colName": "colour",
                      "search": $('#colour').val(),
                      "strict": false,
                      "dataType": "String"},
                     {"colName": "doILike",
                      "search": $('#doILike').is(':checked'),
                      "strict": true,
                      "dataType": "Boolean"}
                    ]
           }};
}


function updateRecord() {
  return {"fruits": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "U",
            "debug": true,
            "sort": "fruit ASC",
            "startVal": -1,
            "pageSize": -1,
            "data": [{"colName": "id",
                      "search": $('#updateSearchId').val(),
                      "strict": false,
                      "useForSearch": true,
                      "new": $('#updateId').val(),
                      "update": false,
                      "dataType": "Number"},
                     {"colName": "fruit",
                      "search": $('#updateSearchFruit').val(),
                      "strict": false,
                      "useForSearch": false,
                      "new": $('#updateFruit').val(),
                      "update": false,
                      "dataType": "String"},
                     {"colName": "colour",
                      "search": $('#updateSearchColour').val(),
                      "strict": false,
                      "useForSearch": false,
                      "new": $('#updateColour').val(),
                      "update": false,
                      "dataType": "String"},
                     {"colName": "doILike",
                      "search": $('#updateSearchDoILike').is(':checked'),
                      "strict": false,
                      "useForSearch": false,
                      "new": $('#updateDoILike').is(':checked'),
                      "update": false,
                      "dataType": "Boolean"},
                     {"colName": "popularity",
                      "search": $('#updateSearchPopularity').val(),
                      "strict": false,
                      "useForSearch": false,
                      "new": $('#updatePopularity').val(),
                      "update": false,
                      "dataType": "Number"}
                    ]
           }};
}



function deleteRecord() {
  return {"fruits": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "D",
            "debug": true,
            "sort": "fruit ASC",
            "startVal": -1,
            "pageSize": -1,
            "data": [{"colName": "id",
                      "search": $('#deleteId').val(),
                      "strict": false,
                      "dataType": "Number"}
                    ]
           }};
}
