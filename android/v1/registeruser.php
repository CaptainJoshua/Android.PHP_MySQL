<?php
// 04 - PHP User Registration
    // include the database operations file
    require_once "../includes/dboperations.php";
    // an array to display the response
    $response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) and isset($_POST['username']) and isset($_POST['password'])) {
        // operate the data further
        $db = new DBOperation();
        // 09 - Unique Email and Password, part of the code
        $result = $db->createUser($_POST['email'], $_POST['username'], $_POST['password']);
        
        if ($result == 1) {
            $response['error'] = false;
            $response['message'] = "User registered successfully!";
        } 
        else if ($result == 2) {
            $response['error'] = true;
            $response['message'] = "Some error occurred please try again.";
        }
        else if ($result == 0) {
            $response['error'] = true;
            $response['message'] = "It seems you are already registered, please choose a different email and username.";
        }
    } 
    else {
        $response['error'] = true;
        $response['message'] = "Required fields are missing. Please fill in the blanks";
    }
} 
else {
    $response['error'] = true;
    $response['message'] = "Invalid Request";
}

echo json_encode($response);