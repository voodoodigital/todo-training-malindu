
<?php
// import backend processes
require("../app/dbQuery.php"); // file navigation is important 


$database = new DB();
$title = trim($_POST['title']);
$date = $_POST['date'];
$time = $_POST['time'];

// validate the title input

if (empty($title) || strlen($title) > 255 || strlen($title) == 0) {
    // the date input is not valid, so display an error message to the user
    echo "Invalid title";
    exit();
}
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
$due_datetime = $date . ' ' . $time;

// current time for Sri Lanka
date_default_timezone_set('Asia/Colombo');
$recorded_datetime = date('Y-m-d H:i:s');


// insert data into MySQL database
$searchQuery = "INSERT INTO todo (`title`, `due_datetime`, `recorded_datetime`, `todo_status_id`) VALUES (?, ?, ?, 1);";
$stmt1 = $database->prepare($searchQuery, "sss", array($title, $due_datetime, $recorded_datetime));


echo "sucess bitch";
