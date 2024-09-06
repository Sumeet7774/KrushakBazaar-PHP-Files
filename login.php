<?php

    require 'connection.php';

    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];
    $user_type = $_POST['user_type'];

    $check_sql = "select * from users WHERE username = ? AND phone_number = ? AND user_type='farmer' ";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("sss", $username, $phone_number, $user_type);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) 
    {
        $response = array('status' => 'found', 'message' => 'user found');
        echo json_encode($response);
    } 
    else 
    {
        $response = array('status' => 'not found', 'message' => 'user not found');
        echo json_encode($response);
    }

    $stmt->close();
    $conn->close();
?>