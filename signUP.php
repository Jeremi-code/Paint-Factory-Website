

<?php

// if (isset($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['password-one']) &&
        isset($_POST['password-two']) && isset($_POST['email'])) {

            $fullName = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password-one'];
            $password_confirm = $_POST['password-two'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "users";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM customers WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO customers(Username, email, password1) values(?, ?, ?)";
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
    
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();
                    if ($password != $password_confirm) {
                        die("Passwords do not match.");
                    }
// Hash the password
                //$password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("sss",$fullName, $email,  $password);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                    echo "record not inserted successfully";
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }

?>