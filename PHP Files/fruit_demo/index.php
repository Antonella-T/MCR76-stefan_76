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
    
    <h2>Update - Not supported yet</h2>
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



    
  </div><!-- wrapper end -->
</body>
</html>
