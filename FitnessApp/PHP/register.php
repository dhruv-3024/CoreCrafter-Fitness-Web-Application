<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect user input from the form
    $username = $_POST["set-username"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $password = $_POST["set-password"];
    // Perform basic input validation (you should enhance this)
    if (empty($username) || empty($email) || empty($password) || empty($contact) || empty($name)) {
        echo "All fields are required.";
    } else {
        // Assuming you have a database connection
        // Replace 'your_database_connection' with your actual database connection code
        $conn = new mysqli("", "localhost", "", "corecrafter");
        
        // Check for connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Hash the password for security (use a secure hashing algorithm)
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Insert user data into the database (replace 'users' with your actual table name)
        $sql = "INSERT INTO users (username, email, password,name,contact) VALUES (?, ?, ?,?,?)";//prepared statements
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password,$contact,$name);
        
        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Registration failed. Please try again.";
        }
        
        // Close the database connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!-- HTML Form for User Registration -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fitness App</title>
    <link rel="stylesheet" href="/CSS/style.css" />
  </head>
  <script src="http://www.datouwang.com/uploads/demo/jiaoben/201507/jiaoben544/js/jquery-2.1.1.min.js"></script>
  <body>
    <div class="wrapper">
      <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
    <div class="login-box">
      <h2>Register</h2>
      <form action="/PHP/register.php" method="get">
        <div class="user-box">
          <input type="text" name="name" required="" />
          <label>Name</label>
        </div>
        <div class="user-box">
          <input type="email" name="email" required="" />
          <label>Email</label>
        </div>
        <div class="user-box">
          <input type="tel" name="contact" required="" />
          <label>Contact Number</label>
        </div>
        <div class="user-box">
          <input type="text" name="set-username" required="" />
          <label>Set Username</label>
        </div>
        <div class="user-box">
          <input type="password" name="set-password" required="" />
          <label>Set Password</label>
        </div>

        <a class="register-btn" href="#">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          Register </a
        ><br />
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <a class="login-btn" href="/HTML/index.html" style="color: aliceblue">
          Already a user?</a
        >

        <br /><br />
      </form>
    </div>
  </body>
</html>
