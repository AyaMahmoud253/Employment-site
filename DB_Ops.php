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

function isEmailExists($email) {
    $conn = dbConnect();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM usersdata WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();

    $stmt->close();
    $conn->close();

    return $count > 0;
}

function saveUserData($full_name, $phone, $email, $qualifications, $resume_location) {
    if (isEmailExists($email)) {
        echo "Error: Email already exists";
        return;
    }
   
    $conn = dbConnect();

    if (!is_dir('resume_files')) {
        mkdir('resume_files');
    }

    $stmt = $conn->prepare("INSERT INTO usersdata (full_name, phone, email, qualifications, resume) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $phone, $email, $qualifications, $resume_location);

    if ($stmt->execute()) {
        echo "Data Inserted";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $qualifications = $_POST["qualifications"];

    $resume_file = $_FILES["resume"]["name"];
    $resume_location = "resume_files/" . $resume_file;
    move_uploaded_file($_FILES["resume"]["tmp_name"], $resume_location);
    saveUserData($full_name, $phone, $email, $qualifications, $resume_location);


}

?>
