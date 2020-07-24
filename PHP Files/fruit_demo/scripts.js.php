<?php
  $myRoot = substr($_SERVER['DOCUMENT_ROOT'], 0, strpos($_SERVER['DOCUMENT_ROOT'], 'public_html'));
  $myPage = $_SERVER['PHP_SELF'];
  require  $myRoot . 'mcr76_hidden/script.php';
?>
//console.log('Hello World!');
var clientTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
var apiKey = 'qe3tq3y1';
$(document).ready(function(){

  $('#createDbTable').click(function() {
    console.log('createDbTable has been clicked!');
    dataString = JSON.stringify(createDbTable);
    $.post("db.php", {"data": dataString},
    function(data,status){
      console.log(data + "\nStatus: " + status);
    });
  }
  );

  $('#removeDbTable').click(function() {
    console.log('removeDbTable has been clicked!');
    dataString = JSON.stringify(removeDbTable);
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


  $('#readDb').click(function() {
    console.log('readDb has been clicked!');
    dataString = JSON.stringify(readDb());
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
           


function readDb() {
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
