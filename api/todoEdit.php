<?php
require("../app/dbQuery.php");


// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required parameters are present
    if (isset($_POST['id'], $_POST['text'])) {
        $id = $_POST['id'];
        $text = $_POST['text'];

        // Create a new instance of the DB class
        $db = new DB();

        // Prepare the update query
        $query = "UPDATE todo SET title = ? WHERE id = ?";
        $stmt = $db->prepare($query, 'si', [$text, $id]);

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            $response = ['status' => 'success'];
        } else {
            $response = ['status' => 'error', 'error' => 'Failed to update todo item'];
        }

        // Close the prepared statement
        $stmt->close();

        // Convert the response to JSON and send it back
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Required parameters are missing
        $response = ['status' => 'error', 'error' => 'Missing required parameters'];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // Invalid request method
    $response = ['status' => 'error', 'error' => 'Invalid request method'];
    header('Content-Type: application/json');
    echo json_encode($response);
}
