<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    $myRoot = substr($_SERVER['DOCUMENT_ROOT'], 0, strpos($_SERVER['DOCUMENT_ROOT'], 'public_html'));
    $myPage = $_SERVER['PHP_SELF'];
    require  $myRoot . 'mcr76_hidden/script.php';
  ?>
  <meta charset="utf-8">
  <title>MCR76 - Fruit DB</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css.php">
  <script>console.log('Home Page Rev 0.5')</script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.js"></script> 
  <script src="scripts/scripts.js.php"></script>  
</head>
<body>
  <div class="wrapper" ng-app="myApp" ng-controller="myCtrl">
    <h1>Welcome to Fruit DB Page</h1>
    
    <button id="createDbTable">Create DB Table</button>
    <button id="removeDbTable">Remove DB Table</button><br>    
    <button id="addTableCol">Add Table Column</button>
    <button id="removeTableCol">Remove Table Column</button><br>
    <button id="importData">Import JSON Data File</button>
    <button id="exportData">Export JSON Data File</button><br>

    <h2>Create</h2>
    <div>
      <label for="createFruit">Fruit:</label><input type="text" id="createFruit">
    </div><div>
      <label for="createColour">Colour:</label><input type="text" id="createColour">
    </div><div>
      <label for="createDoILike">Like:</label><input type="checkbox" id="createDoILike">
    </div><div>
      <label for="createPopularity">Popularity:</label><input type="text" id="createPopularity">
    </div><div>
      <button id="createRecord">Create New Record</button>
    </div>

    <h2>Read</h2>
    <label for="fruit">Fruit:</label><input type="text" id="fruit" value="Banana">
    <label for="colour">Colour:</label><input type="text" id="colour">
    <label for="doILike">Like:</label><input type="checkbox" id="doILike" checked="checked">
    <button id="readRecord">Search</button><br>

    <h2>Read (AngularJS)</h2>
    <h3>Search Values:</h3>
    <div>
      <label for="ngReadId">Id:</label>
      <input type="text" id="ngReadId" ng-model="ngReadId">
    </div><div>
      <label for="ngReadFruit">Fruit:</label>
      <input type="text" id="ngReadFruit" ng-model="ngReadFruit">
      <label for="ngReadFruitStrict">Strict:</label>
      <input type="checkbox" id="ngReadFruitStrict" ng-model="ngReadFruitStrict">
    </div><div>
      <label for="ngReadColour">Colour:</label>
      <input type="text" id="ngReadColour" ng-model="ngReadColour">
      <label for="ngReadColourStrict">Strict:</label>
      <input type="checkbox" id="ngReadColourStrict" ng-model="ngReadColourStrict">
    </div><div>
    </div><div>
      <label for="ngReadDoILike">Like:</label>
      <select id="ngReadDoILike" ng-model="ngReadDoILike">
        <option value="n/a">Don't Care</option>
        <option value=1>Yes</option>
        <option value=0>No</option>
      </select>
    </div><div>
      <label for="ngReadPopularity">Popularity:</label>
      <input type="text" id="ngReadPopularity" ng-model="ngReadPopularity">
    </div><div>
      <button id="ngReadRecord" ng-click="ngReadRecord();">Search Record</button>
    </div>
    <table border="1">
      <tr><th>Id</th><th>Fruit</th><th>Colour</th><th>doILike</th><th>Popularity</th><th>createDate</th><th>updateDate</th></tr>
      <tr ng-repeat="row in ngReadRecordData"><td>{{row.id}}</td><td>{{row.fruit}}</td><td>{{row.colour}}</td><td>{{row.doILike}}</td><td>{{row.popularity}}</td><td>{{row.createDate}}</td><td>{{row.updateDate}}</td></tr>
    </table>


    <h2>Read with Autosuggest (AngularJS)</h2>
    <div>
      <label for="ngReadAuto">Search:</label>
      <input type="text" id="ngReadAuto" ng-model="ngReadAuto" ng-keyup="ngReadAutoRecord();">
    </div>
    <div id="ngReadAutoContainer" ng-show="showNgReadAutoSuggestions">
      <ul>
        <li ng-repeat="row in ngReadAutoRecordData | filter: ngReadAuto | orderBy:fruit" ng-click="ngReadAutoShowDetails(row)">
          {{row.fruit}}
        </li>
      </ul>
    </div>
    <table border="1" ng-show="showNgReadAutoResults">
      <tr><th>Id</th><th>Fruit</th><th>Colour</th><th>doILike</th><th>Popularity</th><th>createDate</th><th>updateDate</th></tr>
      <tr>
        <td>{{ngReadAutoRecordDetails.id}}</td>
        <td>{{ngReadAutoRecordDetails.fruit}}</td>
        <td>{{ngReadAutoRecordDetails.colour}}</td>
        <td>{{ngReadAutoRecordDetails.doILike}}</td>
        <td>{{ngReadAutoRecordDetails.popularity}}</td>
        <td>{{ngReadAutoRecordDetails.createDate}}</td>
        <td>{{ngReadAutoRecordDetails.updateDate}}</td></tr>
    </table>

    
    <h2>Read with Autosuggest (AngularJS + &lt;datalist>)</h2>
    <div>
      <span>{{ngReadAutoMessageDL}}</span><br>
      <label for="ngReadAutoDL">Search:</label>
      <input list="ngReadAutoDLDataList" type="text" id="ngReadAutoDL" ng-model="ngReadAutoDL" ng-change="ngReadAutoRecordDL();"  ng-keyup="ngReadAutoShowDetailsDL()">
      <datalist id="ngReadAutoDLDataList">
        <option ng-repeat="row in ngReadAutoRecordDataDL | filter: ngReadAutoDL | orderBy:fruit" data-value="{{row.id}}">{{row.fruit}}</option>
      </datalist>
    </div>
    <table border="1" ng-show="showNgReadAutoResultsDL">
      <tr><th>Id</th><th>Fruit</th><th>Colour</th><th>doILike</th><th>Popularity</th><th>createDate</th><th>updateDate</th></tr>
      <tr>
        <td>{{ngReadAutoRecordDetailsDL.id}}</td>
        <td>{{ngReadAutoRecordDetailsDL.fruit}}</td>
        <td>{{ngReadAutoRecordDetailsDL.colour}}</td>
        <td>{{ngReadAutoRecordDetailsDL.doILike}}</td>
        <td>{{ngReadAutoRecordDetailsDL.popularity}}</td>
        <td>{{ngReadAutoRecordDetailsDL.createDate}}</td>
        <td>{{ngReadAutoRecordDetailsDL.updateDate}}</td></tr>
    </table>


    <h2>Update</h2>
    <h3>Search Values:</h3>
    <div>
      <label for="updateSearchId">Id:</label><input type="text" id="updateSearchId">
    </div>
    <h3>New Values:</h3>
    <div>
      <label for="updateFruit">Fruit:</label><input type="text" id="updateFruit">
    </div><div>
      <label for="updateColour">Colour:</label><input type="text" id="updateColour">
    </div><div>
      <label for="updateDoILike">Like:</label><input type="checkbox" id="updateDoILike">
    </div><div>
      <label for="updatePopularity">Popularity:</label><input type="text" id="updatePopularity">
    </div --><div>
      <button id="updateRecord">Update Record</button>
    </div>
    
    <h2>Delete</h2>
    <div>
      <label for="deleteId">Id:</label><input type="text" id="deleteId">
    </div><!-- div>
      <label for="deleteFruit">Fruit:</label><input type="text" id="deleteFruit">
    </div><div>
      <label for="deleteColour">Colour:</label><input type="text" id="deleteColour">
    </div><div>
      <label for="deleteDoILike">Like:</label><input type="checkbox" id="deleteDoILike">
    </div><div>
      <label for="deletePopularity">Popularity:</label><input type="text" id="deletePopularity">
    </div --><div>
      <button id="deleteRecord">Delete Record</button>
    </div>

    <h2>File Upload</h2>
    <div>
      <label for="fileUploadPath">Path:</label><input type="text" id="fileUploadPath" value="mcr76_hidden/">
    </div><div>
      <label for="fileUploadName">Name:</label><input type="text" id="fileUploadName" value="test.json">
    </div><div>
      <label for="fileUploadFile">File:</label><input type="file" name="fileUploadFile" id="fileUploadFile">
    </div><div>
      <button id="uploadFile">Upload File</button>
    </div>

    <h2>File Listing</h2>
    <div>
      <label for="fileListingPath">Path:</label><input type="text" id="fileListingPath" value="public_html/mcr76/fruit/">
    </div><div>
      <button id="listFiles">List File(s)</button>
    </div>

    <h2>File Listing (AngularJS)</h2>
    <div>
      <label for="ngFileListingPath">Path:</label><input ng-model="ngFileListingPath" type="text" id="ngFileListingPath">
    </div><div>
      <button id="ngListFiles" ng-click="ngFileListingDisplay()">List File(s)</button>
    </div>
    <table border="1">
      <tr><th>File Name</th><th>File Type</th><th>File Size</th><th>Timestamp</th></tr>
      <tr ng-repeat="row in ngFileListingDetails | orderBy:fileName">
        <td>{{row.fileName}}</td>
        <td>{{row.fileMime}}</td>
        <td>{{row.fileSize | humanFileSize}}</td>
        <td>{{row.unixTime}}</td></tr>
    </table>

    <h2>File Download</h2>
    <form id='fileDownloadForm' method='post' action='db.php' target='_blank'>
    <div>
      <label for="fileDownloadPath">Path:</label><input type="text" name="fileDownloadPath" id="fileDownloadPath" value="mcr76_hidden/">
    </div><div>
      <label for="fileDownloadName">Name:</label><input type="text" name="fileDownloadName" id="fileDownloadName" value="test.json">
    </div><div>
      <input type='hidden' name='data' id="fileDownloadData" value=''>
      <input type='hidden' name='submitting' value='YES'>
      <button id="downloadFile">Download File</button>
    </div>
    </form>

    <h2>File Download (AngularJS)</h2>
    <div>
      <label for="ngFileDownloadPath">Path:</label><input ng-model="ngFileDownloadPath" type="text" id="ngFileDownloadPath">
    </div><div>
      <button id="ngListDownloadFiles" ng-click="ngFileDownloadDisplay()">List Available File(s)</button>
    </div>
    <form id='ngFileDownloadForm' method='post' action='db.php' target='_blank'>
    <table border="1">
      <tr><th>File Name</th><th>File Type</th><th>File Size</th><th>Timestamp</th><th>Download</th></tr>
      <tr ng-repeat="row in ngFileDownloadDetails | orderBy:fileName">
        <td>{{row.fileName}}</td>
        <td>{{row.fileMime}}</td>
        <td>{{row.fileSize | humanFileSize}}</td>
        <td>{{row.unixTime}}</td>
        <td><button type="button" ng-click="ngFileDownload(row)">Download</button></td></tr>
    </table>
    <input type='hidden' name='data' id="ngFileDownloadData" value=''>
    <input type='hidden' name='submitting' value='YES'>
    </form>

    
  </div><!-- wrapper end -->
</body>
</html>
