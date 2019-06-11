<?php
include 'db.php';

// output headers so that the file is downloaded rather than displayed
/* header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv'); */

// create a file pointer connected to the output stream
$output = fopen('file/test.csv', 'w+');
//csv ภาษาไทย
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));



// output the column headings
//fputcsv($output, array('Column 1', 'Column 2', 'Column 3', 'Column 4'));


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * from command;"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach($stmt->fetchAll() as $k=>$v) {
        //$line = array_map("utf8_decode", $v);
        //fputcsv($output, $v);
        //print_r($v);
        //$test[] = $v;
    }
    //print_r($test);
    /* $fp = fopen('file/results.json', 'w');
    fwrite($fp, json_encode($test)); */
    //fputcsv($output, $test);
    //fclose($output);
    $hash2 = password_hash("1234", PASSWORD_DEFAULT);
    //echo password_hash("1234", PASSWORD_DEFAULT);
    echo $hash2;
    // See the password_hash() example to see where this came from.
$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

if (password_verify('rasmuslerdorf', $hash2)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>