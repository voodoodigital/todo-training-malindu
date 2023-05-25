<?php
// import backend processes
require("../app/dbQuery.php"); // file navigation is important 

$database = new DB();
$searchQuery = "SELECT * FROM `todo` ORDER BY `recorded_datetime` DESC";
$results = $database->query($searchQuery);

$responseArray = array();
for ($i = 0; $i < $results->num_rows; $i++) {
  $data = $results->fetch_assoc();

  $todoItemObject = new stdClass();
  $todoItemObject->title = $data["title"];
  $todoItemObject->dueDate = $data["due_datetime"];

  array_push($responseArray, $todoItemObject);
}

$responseJsonText = json_encode($responseArray);
echo ($responseJsonText);
