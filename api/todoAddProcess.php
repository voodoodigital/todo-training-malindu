<?php
// import backend processes
require("../app/dbQuery.php"); // file navigation is important 
require("../app/responseSender.php"); // file navigation is important 



$todoAddData = $_POST['todoAddData'];
$todoAddDataObject = json_decode($todoAddData);
$title = $todoAddDataObject->title;
$date = $todoAddDataObject->date;
$time = $todoAddDataObject->time;



$responseObject = new stdClass();
$responseObject->status = "failed";

// validate the title input
if (empty($title) || strlen($title) > 255 || strlen($title) == 0) {
    // the date input is not valid, so display an error message to the user
    $responseObject->error = "Invalid title";
    ResponseSender::send($responseObject);
}
// validate the date input
$date_obj = DateTime::createFromFormat('Y-m-d', $date);
if (!$date_obj || $date_obj->format('Y-m-d') !== $date) {
    // the date input is not valid, so display an error message to the user
    $responseObject->error = "Invalid date";
    ResponseSender::send($responseObject);
}

// validate the time input
$time_obj = DateTime::createFromFormat('H:i:s', $time);
if (!$time_obj || $time_obj->format('H:i:s') !== $time) {
    // the time input is not valid, so display an error message to the user
    $responseObject->error = "Invalid time";
    ResponseSender::send($responseObject);
}

// combine date and time into a single datetime value
$due_datetime = $date . ' ' . $time;

// current time for Sri Lanka
date_default_timezone_set('Asia/Colombo');
$recorded_datetime = date('Y-m-d H:i:s');


$database = new DB();
// insert data into MySQL database
$searchQuery = "INSERT INTO todo (`title`, `due_datetime`, `recorded_datetime`, `todo_status_id`) VALUES (?, ?, ?, 1);";
$stmt1 = $database->prepare($searchQuery, "sss", array($title, $due_datetime, $recorded_datetime));


$responseObject->status = "success";
ResponseSender::send($responseObject);








