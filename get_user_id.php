<?php

    require 'connection.php';

    $username = $_POST['username'];

    try 
    {
        $query = "select user_id from users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) 
        {
            $row = $result->fetch_assoc();
            echo $row['user_id']; 
        } 
        else 
        {
            echo "user not found"; 
        }

        $stmt->close();
        $conn->close();
    } 
    catch (Exception $e) 
    {
        echo "Error";
    }
?>
