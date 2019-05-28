<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
<div class="container" align="center">

<h2>HTML Forms</h2>

<form action="json.php" method="post">
SQL:<br>
<textarea rows="4" cols="50" name="sql" id="sql" readonly>
</textarea><br>
  Host:<br>
  <input type="text" name="ip">
  <br>
  Port:<br>
  <input type="text" name="port">
  <br>
  DB:<br>
  <input type="text" name="db">
  <br>
  Table Name:<br>
  <input type="text" name="tbname" id="tbname">
  <br>
  Username:<br>
  <input type="text" name="username">
  <br>
  Password:<br>
  <input type="password" name="password">
  <br><br>
  <select id="drop">
<option value="">Please Choose</option>

<?php
include 'db.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * from command"); 
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach($stmt->fetchAll() as $k=>$v) {
        $tbname[$v['id']] = $v['tbname'];
        ?>
        <option id="<?php echo $v['id']?>" value="<?php echo $v['command'];?>"><?php echo $v['name'];?></option>
     <?php   
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
</select>
  <br><br>
  <input type="submit" value="Submit">
</form> 
</div>
<!-- <?php print_r($tbname);?> -->
</body>
<script>
$( document ).ready(function() {
    $("#drop").change(function () {
        //alert("test")
        var sql = this.value
        var tbname = <?php echo json_encode($tbname); ?>;
        var tbid = $(this).children(":selected").attr("id");
        $("#sql").val(sql)
        $("#tbname").val(tbname[tbid])
        //var sql = this.text()
        //alert(sql)
    });
});
</script>
</html>