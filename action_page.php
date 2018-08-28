
<!DOCTYPE html>
<html>
<body>

<?php
// define variables and set to empty values
    $fname = $lname = $addr1 = $addr2 = $city = $state = $zip = $country = "";
    $fnameErr = $lnameErr = $addr1Err = $cityErr = $stateErr = $zipErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["firstname"])) {
            $nameErr = "First name is required";
        }
        else {
            $fname = test_input($_POST["firstname"]);
        }
        
        if (empty($_POST["lastname"])) {
            $nameErr = "Last name is required";
        }
        else {
            $lname = test_input($_POST["lastname"]);
        }
        
        if (empty($_POST["address1"])) {
            $addr1Err = "Address is required";
        }
        else {
            $addr1 = test_input($_POST["address1"]);
        }
        
        $addr2 = test_input($_POST["address2"]);
        
        if (empty($_POST["city"])) {
            $cityErr = "City is required";
        }
        else {
            $city = test_input($_POST["city"]);
        }
        
        if (empty($_POST["state"])) {
            $stateErr = "State is required";
        }
        else {
            $state = test_input($_POST["state"]);
        }
        
        if (empty($_POST["zip"])) {
            $zipErr = "Zip code is required";
        }
        else {
            $zip = test_input($_POST["zip"]);
        }
        
        $country = test_input($_POST["country"]);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    echo $fname;
    echo $lname;
    echo $addr1;
    echo $addr2;
    echo $city;
    echo $state;
    echo $zip;
    echo $country;
    echo "<br>";
    $date = date("Y-m-d H:i:s");
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myDB";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
    
    $sql = "CREATE DATABASE myDB";
    if ($conn->query($sql) == TRUE) {
        echo "Database created successfully";
    } else {
        "Error creating database: " . $conn->error;
    }
    
    $sql = "CREATE TABLE USERS (
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    address1 TEXT(30) NOT NULL,
    address2 TEXT(30),
    city VARCHAR(15) NOT NULL,
    state VARCHAR(15) NOT NULL,
    zip INT(11) NOT NULL,
    country VARCHAR(3) NOT NULL,
    Date DATETIME NOT NULL
    )";
    
    if (mysqli_query($conn, $sql)) {
        echo "Table Users created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
    
    $sql = "INSERT INTO USERS (firstname, lastname, address1, address2, city, state, zip, country, Date)
    VALUES ('{$fname}','{$lname}','{$addr1}','{$addr2}','{$city}','{$state}',{$zip},'{$country}', '{$date}')";
    
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>

</body>
</html>