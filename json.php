<?php

$servername = $_POST['ip'];
$port = $_POST['port'];
$dbname = $_POST['db'];
$username = $_POST['username'];
$password = $_POST['password'];
$sql = $_POST['sql'];
$tbname = $_POST['tbname'];
$field_name = "";
$field_value = "";
$string = "";
$chck = "";
$chckstring = "";
$i = $du = '0';

try {
    $conn = new PDO("mysql:host=$servername:$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //สร้าง ตาราง temp จาก query
    $stmt = $conn->prepare("CREATE TEMPORARY TABLE `temp` $sql;"); 
    $stmt->execute();
    //เช็คว่าตารางที่จะเก็บข้อมูลมีการสร้างไว้หรือยัง?
    $stmt = $conn->prepare("SELECT table_name as d FROM information_schema.tables where table_schema='formdb' and table_name = '$tbname';"); 
    $stmt->execute();
    //ถ้ายังไม่มีการสร้าง จะทำการ CREATE TABLE โดยอ้างอิง datatype จาก ตาราง temp
    if ($stmt->rowCount() < 1){
        $stmt = $conn->prepare("DESCRIBE `temp`"); 
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        foreach($stmt->fetchAll() as $k=>$v) {
            $string .= "`" .$v['Field']. "` " . $v['Type'] . ",";
            }
        $cretable = "CREATE TABLE $tbname (myid INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ".
        substr($string, 0, -1) .")";
        $stmt = $conn->prepare("$cretable"); 
        $stmt->execute();
    }
        //ดึงข้อมูลที่เคย query ไว้จากตาราง temp
        $stmt = $conn->prepare("SELECT * from `temp`"); 
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        foreach($stmt->fetchAll() as $k=>$v) {
            //เข้าไปในตัว array ย่อย เพื่อ ทำการเก็บ key และ value ของ array แต่ละตัว
            foreach($v as $key => $value){
                $field_name .= "`" .$key. "`, " ;
                $field_value .= "'" .addslashes($value). "', " ;
                //สร้างเพื่อไว้เช็คว่า array ตัวนี้เคยมีการ insert หรือเปล่า?
                $chck .= "`" .$key. "` = '" .addslashes($value). "' and ";
            }
            //query เพื่อเช็คว่าเคยมีการ insert หรือไม่ โดยค่าจะต้องเหมือนเดิมเป๊ะ!!!
            $chckstring = "SELECT * from " .$tbname ." where ". substr($chck, 0, -4) ;
            $stmt = $conn->prepare("$chckstring"); 
            $stmt->execute();
            //ถ้ายังไม่เคยมีการ Inserted จะทำการ Insert เพิ่มเข้าไป
            if ($stmt->rowCount() < 1){
                $i += 1;
                $string = "INSERT INTO " .$tbname ." (". substr($field_name, 0, -2) . ") VALUES (" . substr($field_value, 0, -2) . ")" ;
                $stmt = $conn->prepare("$string"); 
                $stmt->execute();
            }
            //นอกเหนือจะแค่ทำการนับตัวซ้ำ
            else{
                $du += 1;
            }
            //เคลียค่าตัวแปร
            $field_name = "";
            $field_value = "";
            $chck = "";
            }
            echo "เพิ่มทั้งหมด " . $i ." รายการ ซ้ำทั้งหมด " . $du . " รายการ";


    // set the resulting array to associative
    /* $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach($stmt->fetchAll() as $k=>$v) {
        //$field_name .= "`" .$k. "`, " ;
        foreach($v as $key => $value){
            $field_name .= "`" .$key. "`, " ;
            $field_value .= "`" .$value. "`, " ;
            //print_r($key);
        }
        $string = "INSERT INTO kpiprovince (" . substr($field_name, 0, -2) . ") VALUES (" . substr($field_value, 0, -2) . ")" ;
        echo $string;
        $field_name = "";
        $field_value = "";
        //echo $field_name;
        //$duck[$v['id']] = $v;
        //$duck[] = $v;
        //echo $field_name;
    } */
    //$string = "INSERT INTO kpiprovince (". $field_name . ") VALUES (" . substr($field_value, 0, -2) . ")" ;
    //echo $string;
    /* $url = 'http://localhost/github/formdb/recieved.php';
    //$url = 'http://localhost/github/testyii/testfuck/create2';
    //$url = 'http://61.19.202.219/ssjta/jotform/submit.php';
    //$url = 'http://61.19.202.218/rpst/4.php';
    // เพิ่ม ค่าเข้าไปใน array เพื่อตรวจสอบ token
    $duck += ['test' => "duck"];
    $post = 'data='.json_encode($duck);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    curl_exec($ch);
    curl_close($ch);    
    //print_r($duck); */
    //print_r($duck);

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>