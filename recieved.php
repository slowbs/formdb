<?php

//ตัวทดสอบ
if (!empty($_POST["data"])) {
    $content = json_decode($_POST['data'],true);

    echo "recieved Mother fucker!!";
//print_r($content);
print("<pre>".print_r($content,true)."</pre>");
//$name = $content['a1'];
//$email = $content['a2'];
//echo $name;
//include 'db.php';

/* $servername = "localhost";
$username = "slowbs";
$password = "sodsongig4";
$dbname = "rpst";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO testpost (name, email)
    VALUES ('$name','$email')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
}
else {  
    echo "there is no data"; */
}


?>