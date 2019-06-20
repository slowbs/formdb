<!DOCTYPE html>
<html>
<head>
<head>
  <title>SSJ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
</head>
<body>

<div class="container" align="center">
<h1>ฟอร์ม</h1>
<div align="right">
  <a href="login.php" class="btn btn-success" role="button" aria-pressed="true">เข้าสู่ระบบ</a>
</div>
<form action="json4.php" method="post">
<div class="row">
    <div class="col-md">
        <div class="row">
            <div class="col-6">
                Host: <input type="text" class="form-control" name="ip" required>
            </div>
            <div class="col-3">
                Port:<input type="text" class="form-control" name="port" required>
            </div>
            <div class="col-3">
                DB: <input type="text" class="form-control" name="db" required>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                Username: <input type="text" class="form-control"  name="username" required>
            </div>
            <div class="col-6">
                Password: <input type="password" class="form-control" name="password" required>
            </div>
        </div>
    </div>
    <div class="col-md">
    เลือกหัวข้อ:
    <select id="drop" class="form-control" required>
        <option value="">Please Choose</option>
<?php
include 'db.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
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
        Table Name: <input type="text" class="form-control"  name="tbname" id="tbname" readonly>
        SQL: <textarea rows="4" class="form-control" cols="50" name="sql" id="sql" readonly></textarea>
    </div>
  </div>
  <br>
  <input type="submit" class="btn btn-primary" value="Submit">
</form> 
</div>
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