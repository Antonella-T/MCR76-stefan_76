<?php
  $myRoot = substr($_SERVER['DOCUMENT_ROOT'], 0, strpos($_SERVER['DOCUMENT_ROOT'], 'public_html'));
  $myPage = $_SERVER['PHP_SELF'];
  require  $myRoot . 'mcr76_hidden/script.php';
  header('Content-Type: application/javascript');
?>
console.log('JavaScript File Rev 0.5');
//console.log('Hello World!');

/* purpose values for data rows: C = create, R = read, U = update, D = delete (CRUD)
   other purpose values: CT = create database table, RT = remove database table
                         AC = add col to table, RC = remove col from table, 
                         ID = import data, ED = export data
                         FU = file upload, FL = file listing, FL file download
*/

var clientTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
var apiKey = 'qe3tq3y1';
$(document).ready(function(){

  $('#createDbTable').click(function() {
    console.log('createDbTable has been clicked!');
    dataString = JSON.stringify(createDbTable);
    $.post("db.php", {"data": dataString},
    function(data,status){
      //console.log(data + "\nStatus: " + status);
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
    console.log('dataString: ', dataString);
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

  $('#uploadFile').click(function() {
    console.log('uploadFile has been clicked!');
    var dataString = JSON.stringify(uploadFile());
    var formData = new FormData();
    formData.append('data', dataString);
    var fileFormField = $('#fileUploadFile')[0];
    //console.log(fileFormField);
    formData.append('file', fileFormField.files[0], $('#fileUploadName'));
    $.ajax({
      url: "db.php",
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,    
      success: function (data, status) {
        //console.log(data);
        console.log(JSON.parse(data), "\nStatus: " + status);
      }
    });
  }
  );

  $('#listFiles').click(function() {
    console.log('listFiles has been clicked!');
    dataString = JSON.stringify(listFiles());
    $.post("db.php", {"data": dataString},
    function(data,status){
      console.log(data);
      console.log(JSON.parse(data), "\nStatus: " + status);
    });
  }
  );

  $('#downloadFile').click(function(e) {
    console.log('downloadFile has been clicked!');
    e.preventDefault();
    dataString = JSON.stringify(downloadFile());
    $('#fileDownloadData').val(dataString);
    // Download needs to be triggered with <a> or <form>
    $('#fileDownloadForm').submit();
    // This happens independant to download with submit()
    $.post("db.php", {"data": dataString},
    function(data,status){
     // console.log(data);
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
            "data": [{"colName":"comments",
                      "unique": false,
                      "dataType":"String",
                      "dataLength": 255},
                     {"colName":"price",
                      "unique": false,
                      "dataType":"Number",
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
            "sort": "n/a",
            "startVal": -1,
            "pageSize": -1,
            "data": [{"colName": "id",
                      "search": $('#updateSearchId').val(),
                      "strict": true,
                      "useForSearch": true,
                      "new": -1,
                      "update": false,
                      "dataType": "Number"},
                     {"colName": "fruit",
                      "search": "",
                      "strict": false,
                      "useForSearch": false,
                      "new": $('#updateFruit').val(),
                      "update": true,
                      "dataType": "String"},
                     {"colName": "colour",
                      "search": "",
                      "strict": false,
                      "useForSearch": false,
                      "new": $('#updateColour').val(),
                      "update": true,
                      "dataType": "String"},
                     {"colName": "doILike",
                      "search": false,
                      "strict": false,
                      "useForSearch": false,
                      "new": $('#updateDoILike').is(':checked'),
                      "update": true,
                      "dataType": "Boolean"},
                     {"colName": "popularity",
                      "search": 0,
                      "strict": false,
                      "useForSearch": false,
                      "new": $('#updatePopularity').val(),
                      "update": true,
                      "dataType": "Number"}
                    ]
           }};
}



function deleteRecord() {
  return {"fruits": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "D",
            "debug": true,
            "sort": "n/a",
            "startVal": -1,
            "pageSize": -1,
            "data": [{"colName": "id",
                      "search": $('#deleteId').val(),
                      "strict": false,
                      "dataType": "Number"}
                    ]
           }};
}

function uploadFile() {
  return {"_file_": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "FU",
            "debug": true,
            "path": $('#fileUploadPath').val(),
            "name": $('#fileUploadName').val(),
            "sort": "n/a",
            "startVal": -1,
            "pageSize": -1
            }};
}

function listFiles() {
  return {"_file_": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "FL",
            "debug": true,
            "path": $('#fileListingPath').val(),
            "name": "n/a",
            "sort": "n/a",
            "startVal": -1,
            "pageSize": -1
            }};
}

function downloadFile() {
  return {"_file_": {"apiKey": apiKey,
            "timeZone": clientTimeZone,
            "purpose": "FD",
            "debug": true,
            "path": $('#fileDownloadPath').val(),
            "name": $('#fileDownloadName').val(),
            "sort": "n/a",
            "startVal": -1,
            "pageSize": -1
            }};
}



var app = angular.module('myApp', []);


app.filter('humanFileSize', function() {
  return function(bytes) {
    var decimals = 2;
    if (bytes === 0) return '0 Bytes';
    var k = 1024;
    var dm = decimals < 0 ? 0 : decimals;
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    var i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
  }
});


app.controller('myCtrl', function($scope, $http, $log) {
    
  //pre-define values for checkboxes and select to avoid 'undefined'
  $scope.ngReadFruitStrict = false;
  $scope.ngReadColourStrict = false;
  $scope.ngReadDoILike = 'n/a';
  
  //Autosuggest default settings
  $scope.showNgReadAutoSuggestions = false;
  $scope.showNgReadAutoResults = false;

  //Autosuggest with <datalist> default settings
  $scope.ngRefreshCharCountDL = 0;
  $scope.ngReadAutoMessageDL = '';
  $scope.showNgReadAutoResultsDL = false;

  $scope.ngReadRecord= function() {
    var data = [];
    if ($scope.ngReadId) {
      $log.info('Id is a search parameter');
      data.push({"colName": "id",
                      "search": $scope.ngReadId,
                      "strict": false,
                      "dataType": "Number"});
    }
    if ($scope.ngReadFruit) {
      $log.info('Fruit is a search parameter');
      data.push({"colName": "fruit",
                      "search": $scope.ngReadFruit,
                      "strict": $scope.ngReadFruitStrict,
                      "dataType": "String"});
    }
    if ($scope.ngReadColour) {
      $log.info('Colour is a search parameter');
      data.push({"colName": "colour",
                      "search": $scope.ngReadColour,
                      "strict": $scope.ngReadColourStrict,
                      "dataType": "String"});
    }
    if ($scope.ngReadPopularity) {
      $log.info('Popularity is a search parameter');
      data.push({"colName": "popularity",
                      "search": $scope.ngReadPopularity,
                      "strict": true,
                      "dataType": "Number"});
    }
    console.log($scope.ngReadDoILike);
    if ($scope.ngReadDoILike != 'n/a') {
      $log.info('DoILike is a search parameter');
      data.push({"colName": "doILike",
                      "search": $scope.ngReadDoILike,
                      "strict": true,
                      "dataType": "Boolean"});
    }
    $log.info(data);
    var jsObj = {"fruits": {"apiKey": apiKey,
                            "timeZone": clientTimeZone,
                            "purpose": "R",
                            "debug": true,
                            "sort": "n/a",
                            "startVal": -1,
                            "pageSize": -1,
                            "data": data}}
    $log.info(jsObj);
    var formData = 'data=' + JSON.stringify(jsObj);
    $http({
      url: 'db.php',
      method: "POST",
      data: formData,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function (response) {
        $log.info('Post Data Submitted Successfully!');
        //$log.info(response);
        //$log.info(response['data']);
        $log.info(response.data, "\nStatus: " + response.status);
        $scope.ngReadRecordData = response.data.data.fruits;
    }, function (response) {
        $log.info('status:', response.status);
    });
  };


  $scope.ngReadAutoRecord = function() {
    if ($scope.ngReadAuto.length >2) {
      //$log.info('Auto Suggest: ', $scope.ngReadAuto);
      if ($scope.showNgReadAutoSuggestions == false) {
        $scope.showNgReadAutoResults = false;
        $log.info('Will search DB for: ', $scope.ngReadAuto);
        var data = [{"colName": "fruit",
                      "search": $scope.ngReadAuto,
                      "strict": false,
                      "dataType": "String"}];
        $log.info('data: ', data);
    var jsObj = {"fruits": {"apiKey": apiKey,
                            "timeZone": clientTimeZone,
                            "purpose": "R",
                            "debug": true,
                            "sort": "n/a",
                            "startVal": -1,
                            "pageSize": -1,
                            "data": data}}
    $log.info(jsObj);
    var formData = 'data=' + JSON.stringify(jsObj);
    $http({
      url: 'db.php',
      method: "POST",
      data: formData,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function (response) {
        $log.info('Post Data Submitted Successfully!');
        //$log.info(response);
        //$log.info(response['data']);
        $log.info(response.data, "\nStatus: " + response.status);
        $scope.ngReadAutoRecordData = response.data.data.fruits;
    }, function (response) {
        $log.info('status:', response.status);
    });
      }
      //ngReadAutoRecordData
      $scope.showNgReadAutoSuggestions = true;
    }
    else {
      $scope.showNgReadAutoSuggestions = false;
    }
  };
  

  $scope.ngReadAutoShowDetails = function(row) {
    $log.info('Displaying details: ', row);
    $scope.showNgReadAutoSuggestions = false;
    $scope.ngReadAuto = '';
    $scope.showNgReadAutoResults = true;
    $scope.ngReadAutoRecordDetails = row;
  }


  $scope.ngReadAutoRecordDL = function() {
    //$log.info('$scope.ngReadAutoDL.length: ', $scope.ngReadAutoDL.length);
    //$log.info('$scope.ngRefreshCharCountDL: ', $scope.ngRefreshCharCountDL);
    if ($scope.ngReadAutoDL.length == 3 && $scope.ngRefreshCharCountDL < 3) {
      $log.info('Auto Suggest <datalist>: ', $scope.ngReadAutoDL);
      $log.info('Will search DB for: ', $scope.ngReadAutoDL);
      var data = [{"colName": "fruit",
                  "search": $scope.ngReadAutoDL,
                  "strict": false,
                  "dataType": "String"}];
      $log.info('data: ', data);
      var jsObj = {"fruits": {"apiKey": apiKey,
                              "timeZone": clientTimeZone,
                              "purpose": "R",
                              "debug": true,
                              "sort": "n/a",
                              "startVal": -1,
                              "pageSize": -1,
                              "data": data}}
      $log.info(jsObj);
      var formData = 'data=' + JSON.stringify(jsObj);
      $log.info(formData);
      $http({
        url: 'db.php',
        method: "POST",
        data: formData,
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).then(function (response) {
        $log.info('Post Data Submitted Successfully!');
        //$log.info(response);
        //$log.info(response['data']);
        $log.info(response.data, "\nStatus: " + response.status);
        $scope.ngReadAutoRecordDataDL = response.data.data.fruits;
        // Workaround: This is required to force the browser to refresh the datalist
        $('#ngReadAutoDL').attr("autocomplete","off");
        $('#ngReadAutoDL').attr("autocomplete","on");
        $('#ngReadAutoDL').focus();
        // Woraround END
      }, function (response) {
        $log.info('status:', response.status);
      });
    }
    else if ($scope.ngReadAutoDL.length < 3) {
      // Clear the datalist as it doesn't reflect the search any longer
      $scope.ngReadAutoRecordDataDL = [];
      // Workaround: This is required to force the browser to refresh the datalist
      $('#ngReadAutoDL').attr("autocomplete","off");
      $('#ngReadAutoDL').attr("autocomplete","on");
      $('#ngReadAutoDL').focus();
      // Woraround END
    }
    $scope.ngRefreshCharCountDL = $scope.ngReadAutoDL.length;
  }
  $scope.ngReadAutoShowDetailsDL = function() {
    $scope.ngReadAutoMessageDL = '';
    $scope.showNgReadAutoResultsDL = false;
    $log.info('event.keyCode: ', event.keyCode);
    // Check if input is not a character OR enter key has been pressed
    if (!event.keyCode || event.keyCode == 13) {
      $scope.ngReadAutoMessageDL = 'Please select a item from the options list.';
      $log.info('Selection made:', $scope.ngReadAutoDL);
      // Check if entry is valid, e.g. item from the datalist selected
      $scope.ngReadAutoRecordDataDL.forEach(function(row) {
        //$log.info(row.fruit);
        if (row.fruit == $scope.ngReadAutoDL) {
          $log.info('Valid Selection');
          // Remove focus with blur to collapse the datalist options
          $('#ngReadAutoDL').blur();
          $scope.ngReadAutoMessageDL = '';
          $scope.showNgReadAutoResultsDL = true;
          $scope.ngReadAutoRecordDetailsDL = row;
        }
      });
    }
  }
  
  // Default values for file management
  $scope.ngFileListingPath = "mcr76_hidden/";
  $scope.ngFileDownloadPath = "mcr76_hidden/";
  
  $scope.ngFileListingDisplay = function() {
    $log.info('Getting details for directory: ', $scope.ngFileListingPath);
    var jsObj = {"_file_": {"apiKey": apiKey,
                            "timeZone": clientTimeZone,
                            "purpose": "FL",
                            "debug": true,
                            "path": $scope.ngFileListingPath,
                            "name": "n/a",
                            "sort": "n/a",
                            "startVal": -1,
                            "pageSize": -1
                            }};
    $log.info(jsObj);
    var formData = 'data=' + JSON.stringify(jsObj);
    $log.info(formData);
    $http({
      url: 'db.php',
      method: "POST",
      data: formData,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function (response) {
      $log.info('Post Data Submitted Successfully!');
      //$log.info(response);
      //$log.info(response['data']);
      $log.info(response.data, "\nStatus: " + response.status);
      $scope.ngFileListingDetails = response.data.data;
    }, function (response) {
      $log.info('status:', response.status);
    });
  }

  $scope.ngFileDownloadDisplay = function() {
    $log.info('Getting details for directory: ', $scope.ngFileDownloadPath);
    var jsObj = {"_file_": {"apiKey": apiKey,
                            "timeZone": clientTimeZone,
                            "purpose": "FL",
                            "debug": true,
                            "path": $scope.ngFileDownloadPath,
                            "name": "n/a",
                            "sort": "n/a",
                            "startVal": -1,
                            "pageSize": -1
                            }};
    $log.info(jsObj);
    var formData = 'data=' + JSON.stringify(jsObj);
    $log.info(formData);
    $http({
      url: 'db.php',
      method: "POST",
      data: formData,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function (response) {
      $log.info('Post Data Submitted Successfully!');
      //$log.info(response);
      //$log.info(response['data']);
      $log.info(response.data, "\nStatus: " + response.status);
      $scope.ngFileDownloadDetails = response.data.data;
    }, function (response) {
      $log.info('status:', response.status);
    });
  }
  
  $scope.ngFileDownload = function(row) {
    $log.info('row: ', row);
    var jsObj = {"_file_": {"apiKey": apiKey,
                            "timeZone": clientTimeZone,
                            "purpose": "FD",
                            "debug": true,
                            "path": $scope.ngFileDownloadPath,
                            "name": row.fileName,
                            "sort": "n/a",
                            "startVal": -1,
                            "pageSize": -1
                            }};
    $log.info(jsObj);
    var formData = JSON.stringify(jsObj);
    $('#ngFileDownloadData').val(formData);
    $log.info(formData);
    // Download needs to be triggered with <a> or <form>
    $('#ngFileDownloadForm').submit();
    // This happens independant to download with submit()
    $http({
      url: 'db.php',
      method: "POST",
      data: 'data=' + formData,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function (response) {
      $log.info('Post Data Submitted Successfully!');
      //$log.info(response);
      //$log.info(response['data']);
      $log.info(response.data, "\nStatus: " + response.status);
    }, function (response) {
      $log.info('status:', response.status);
    });
    
  }


});



/*
    
    dataString = JSON.stringify(downloadFile());
    
    $.post("db.php", {"data": dataString},
    function(data,status){
     // console.log(data);
      console.log(JSON.parse(data), "\nStatus: " + status);
    });

*/





