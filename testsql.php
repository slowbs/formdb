<?php

include 'db.php';
$string = "";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("CREATE TEMPORARY TABLE `temp` SELECT * FROM province limit 0;"); 
    $stmt->execute();
    

    $stmt = $conn->prepare("SELECT table_name as d FROM information_schema.tables where table_schema='formdb' and table_name = 'province';"); 
    $stmt->execute();
    if ($stmt->rowCount() < 1){
        $stmt = $conn->prepare("DESCRIBE `temp`"); 
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        foreach($stmt->fetchAll() as $k=>$v) {
            $string .= "`" .$v['Field']. "` " . $v['Type'] . ", <br>";
            }
        $cretable = "CREATE TABLE didi (myid INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ".
        substr($string, 0, -6) .")";
        echo $cretable;
    }
    else{
        $stmt = $conn->prepare("SELECT * from province"); 
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        foreach($stmt->fetchAll() as $k=>$v) { 
            print_r($v);
        }
    }
    
    // set the resulting array to associative
    
    
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>