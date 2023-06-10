<?php
require("../app/dbQuery.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Create an instance of the DB class
    $db = new DB();
    $number=2;

     // Prepare the update query
     $query = "UPDATE todo SET todo_status_id = ? WHERE id = ?";
     $stmt = $db->prepare($query, 'si', [$number, $id]);


   
    // Check for any errors
    if ($stmt->error) {
        $response = array( 
            'status' => 'error',
            'error' => $stmt->error
        );
    } else {
        $response = array(
            'status' => 'success',
            'status_id'=>'2'

        );
    }

    // Return the response as JSON
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'error' => 'Id not provided'
    );

    // Return the response as JSON
    echo json_encode($response);
}
