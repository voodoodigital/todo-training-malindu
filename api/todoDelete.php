<?php
require("../app/dbQuery.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Create an instance of the DB class
    $db = new DB();

    // Prepare the DELETE statement with a placeholder for the index
    $query = "DELETE FROM todo WHERE id = ?";

    // Bind the index parameter and execute the statement
    $stmt = $db->prepare($query, 'i', [$id]);
    $stmt->execute();

    // Check for any errors
    if ($stmt->error) {
        $response = array( 
            'status' => 'error',
            'error' => $stmt->error
        );
    } else {
        $response = array(
            'status' => 'success'
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
