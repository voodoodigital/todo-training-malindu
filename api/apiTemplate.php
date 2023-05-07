<?php

// user access validation by check if the user is logged in from the request source. (if needed)

// get the request data
// only use one
// most requests comes in JSON format
$request = $_GET["requestParameter"]; // if req on GET method
$request = $_POST["requestParameter"]; // if req on POST method
$requestObject = json_decode($request);

// import backend processes
require("../app/templateBackendProcess.php"); // file navigation is important 


// do the APi process
// ---> any process you need to do can be done here. also you can use predefined classes in other classes that you imported to this doc
// make sure to create classes in 'app' folder for specific tasks.
// only program bias process for the eact usecase and repeated processes can be create in the 'app' as classes and can  reuse in here


// send the response
$responseObject = new stdClass(); // if response in object format
$responseObject->objectProperty1 = 'response data'; //  add data to an object
$responseObject->objectProperty2 = 'response data';

$responseArray = array(); //  if response in array format
$responseArray = array_push($responseArray, 'new data to array'); // add data to array

$responseJsonText = json_encode($response); // for arrays and objects
echo ($responseJsonText);


$response = 'array or a value or an object which contains all the response data'; // if response in just text
echo ($response); // for just text responses






