<?php

function dbConnect() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_user";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function getUsers() {
    $conn = dbConnect();

    $sql = "SELECT * FROM usersdata";
    $result = $conn->query($sql);

    $users = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    $conn->close();

    return $users;
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Resume Management Page</title>
  <!-- Add your CSS stylesheets and JavaScript files here -->
  <style>
    /* Add your custom styles for the Resume Management Page */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.22);
    }
    
    h1 {
      margin-top: 0;
    }
    
    .resume-list {
      list-style: none;
      padding: 0;
    }
    
    .resume-list li {
      margin-bottom: 10px;
      padding: 10px;
      background-color: #f9f9f9;
      border-radius: 5px;
    }
    
    .resume-list li:hover {
      background-color: #e6e6e6;
    }
    
    .resume-list li h3 {
      margin-top: 0;
    }
    
    .resume-list li p {
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <?php
    include("header.php");
  ?>
  <br>
  <div class="container">
    <h1>Resume Management</h1>
  
    <ul>
    <?php
    $users = getUsers();
    foreach ($users as $user) {
        echo "<li>";
        echo "<h3>" . $user['full_name'] . "</h3>";
        echo "<p>Email: " . $user['email'] . "</p>";
        echo "<p>Phone: " . $user['phone'] . "</p>";
        echo "<p>Qualifications: " . $user['qualifications'] . "</p>";
        echo "<p><a href='" . $user['resume'] . "' target='_blank'>View Resume</a></p>";
        echo "</li>";
    }
    ?>
</ul>
  </div>
  
</body>
</html>
