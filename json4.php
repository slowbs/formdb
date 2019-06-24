<?php
//INSERT โดยไม่ตรวจสอบ only inSERT ใช้วิธี SINGLE INSERT with MULTIPLE VALUES
$servername2 = $_POST['ip'];
$port2 = $_POST['port'];
$dbname2 = $_POST['db'];
$username2 = $_POST['username'];
$password2 = $_POST['password'];
$sql = $_POST['sql'];
$tbname = $_POST['tbname'];
$field_name = $field_name2 = $field_value = $field_value2 = $condition = "";
$ran = rand () ;
$string = "";


try {
    //เช็คว่าตารางที่จะเก็บข้อมูลมีการสร้างไว้หรือยัง?
    include 'db.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn2 = new PDO("mysql:host=$servername2:$port2;dbname=$dbname2;charset=utf8", $username2, $password2);
    $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT table_name as d FROM information_schema.tables where table_schema='formdb' and table_name = '$tbname';"); 
    $stmt->execute();
    $stmt2 = $conn2->prepare("CREATE TEMPORARY TABLE `temp` $sql;"); 
    $stmt2->execute();
    $stmt2 = $conn2->prepare("DESCRIBE `temp`"); 
        $stmt2->execute();
        $result2 = $stmt2->setFetchMode(PDO::FETCH_ASSOC); 
        foreach($stmt2->fetchAll() as $k=>$v) {
            $string .= "`" .$v['Field']. "` " . $v['Type'] . ",";
            }
        $cretable = "CREATE TABLE $tbname (myid INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ".
        substr($string, 0, -1) .",
        date_created DATETIME)";
    //ถ้ายังไม่มีการสร้าง จะทำการ CREATE TABLE โดยอ้างอิง datatype จาก ตาราง temp
    if ($stmt->rowCount() < 1){
        //สร้าง ตาราง temp จาก query
        $stmt = $conn->prepare("$cretable"); 
        $stmt->execute();
        //echo $cretable ."; <br>";
    }
        //ดึงข้อมูลที่เคย query ไว้จากตาราง temp
        $stmt2 = $conn2->prepare("SELECT * from `temp`"); 
        $stmt2->execute();
        $result2 = $stmt2->setFetchMode(PDO::FETCH_ASSOC); 
        foreach($stmt2->fetchAll() as $k=>$v) {
            //เข้าไปในตัว array ย่อย เพื่อ ทำการเก็บ key และ value ของ array แต่ละตัว
            foreach($v as $key => $value){
                $field_name .= "`" .$key. "`, " ;
                $field_value .= "'" .addslashes($value). "', " ;
                $condition .= "`".$ran ."`.`" . $key . "`=" . $tbname . ".`" .$key ."` and ";
            }
            //$i += 1;
            $field_name2 = "INSERT INTO `" .$ran ."` (". substr($field_name, 0, -2) . ", `date_created`) VALUES ";
            $loaddata = "LOAD DATA INFILE 'C:/xampp/htdocs/github/formdb/file/".$ran.".txt' INTO TABLE `" .$tbname ."` (". substr($field_name, 0, -2) . ", `date_created`)";
            $field_value2 .= "(" . substr($field_value, 0, -2) .", NOW()), ";
            $condition2 = "SELECT * INTO OUTFILE 'C:/xampp/htdocs/github/formdb/file/".$ran.".txt' FROM `".$ran."` WHERE NOT EXISTS ( SELECT * FROM `".$tbname."` where "
            . substr($condition, 0, -4) .")";
            $field_name = $field_value = $condition = "";
            }
            
            $string4 = $field_name2 . $field_value2;
            $string4 = substr($string4, 0, -2);
            //echo $string;
            //echo $ran;
            $cretable = "CREATE TABLE `".$ran."` (".
            substr($string, 0, -1) .",
            date_created DATETIME)";
            $drop = "DROP TABLE `".$ran."`";
            $sql2 = $cretable.";".$string4.";".$condition2.";".$drop.";";
            //echo $sql2;
            $stmt = $conn->prepare("$sql2"); 
            $stmt->execute();
            /* $stmt = $conn->prepare("$string4"); 
            $stmt->execute();
            $stmt = $conn->prepare("$condition2"); 
            $stmt->execute();
            $stmt = $conn->prepare("$drop"); 
            $stmt->execute(); */
            $stmt = $conn->prepare("$loaddata"); 
            $stmt->execute();
            $count = $stmt->rowCount();
            unlink("C:/xampp/htdocs/github/formdb/file/".$ran.".txt");
            echo "เพิ่มทั้งหมด " . $count . " รายการ <BR>";
            /* echo $cretable ."; <BR>";
            echo $string4 ."; <BR>";
            echo $condition2 ."; <BR>";
            echo $loaddata .";"; */
            /* $stmt = $conn->prepare("$string"); 
            $stmt->execute();
            //echo substr($string, 0, -2);
            echo "เพิ่มทั้งหมด " . $i ." รายการ"; */

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
$conn2 = null;
?>