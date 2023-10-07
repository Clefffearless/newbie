<?php
session_start();

include("database.php"); // Include database.php first

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use a prepared statement to avoid SQL injection
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        // ... Rest of your code ...
    }
}
        // Use a prepared statement to fetch user data
        $stmt = mysqli_prepare($conn, 'SELECT * FROM `group2` WHERE 1');
        $stmt = mysqli_prepare($conn, "INSERT INTO `group2`(`id`, `user`, `pass`) VALUES ('[value-1]','[value-2]','[value-3]')");
       
        if ($result === false) {
            die("Database query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                // Authentication successful
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['img_status'] = $row['img_status'];
                mysqli_stmt_close($stmt); // Close the prepared statement
                mysqli_close($conn); // Close the database connection
                header("Location: home.php");
                exit();
            } else {
                // Password is incorrect
                echo "<script>alert('Invalid Password');</script>";
                header("Location: index.php");
                exit();
            }
        } else {
            // User not found
            header("Location: index.php?UserNotFound");
            exit();
        }
  
?>
