
<?php
// import backend processes
require("../app/dbQuery.php"); // file navigation is important 


$database = new DB();
$date=$_POST['date'];
$time=$_POST['time'];

// validate the date input
$date_obj = DateTime::createFromFormat('Y-m-d', $date);
if (!$date_obj || $date_obj->format('Y-m-d') !== $date) {
  // the date input is not valid, so display an error message to the user
  echo "Invalid date";
  exit();
}

// validate the time input
$time_obj = DateTime::createFromFormat('H:i:s', $time);
if (!$time_obj || $time_obj->format('H:i:s') !== $time) {
  // the time input is not valid, so display an error message to the user
  echo "Invalid time";
  exit();
}

// combine date and time into a single datetime value
$datetime = $date . ' ' . $time;

// insert data into MySQL database
$searchQuery = "INSERT INTO todo (due_datetime) VALUES (?);";
$stmt1=$database->prepare($searchQuery,"s",array($datetime));


echo"sucess bitch";









/*$database = new DB();
$searchQuery = "SELECT * FROM `todo`";
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
echo ($responseJsonText);*/
