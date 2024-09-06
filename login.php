<?php

require 'connection.php';

$username = $_POST['username'];
$password = $_POST['password'];
$user_type = $_POST['user_type'];

$check_sql = "SELECT password FROM users WHERE username = ? AND user_type = ?";
$stmt = $conn->prepare($check_sql);
$stmt->bind_param("ss", $username, $user_type);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    if (password_verify($password, $hashed_password)) 
    {
        $response = array('status' => 'found', 'message' => 'user found');
    } else {
        $response = array('status' => 'not found', 'message' => 'invalid password');
    }
} else {
    $response = array('status' => 'not found', 'message' => 'user not found');
}

echo json_encode($response);

$stmt->close();
$conn->close();

?>