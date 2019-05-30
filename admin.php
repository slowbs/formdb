    
<?php 
	include('functions.php');
    if (!isAdmin()) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../user/login.php');
    }
    $id = $_SESSION['user']['id'];
    $duck = $_SESSION['user']['username'];
    $user_type = $_SESSION['user']['user_type'];

    echo $duck ." <br> " . $user_type . "<br>";
    include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
  
<div class="container">
  <h1>My First Bootstrap Page</h1>
  <p>This part is inside a .container class.</p> 
  <p>The .container class provides a responsive fixed width container.</p>
  <div align="right">
  <a href="login.php?logout='1'">ออกจการะบบ</a>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#insertModal" id="<?php echo $v['id'];?>">
    ADD
  </button>
  </div>

  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">TB_Name</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
  <?php

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * from command;"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach($stmt->fetchAll() as $k=>$v) { ?>
    <tr>
      <th scope="row"><?php echo $v['id'];?></th>
      <td><?php echo $v['name'];?></td>
      <td><?php echo $v['tbname'];?></td>
      <td><!-- <button type="button" class="btn btn-primary handle" data-toggle="modal" data-target="#sqlModal" id="<?php echo $v['id'];?>">
    SQL
  </button> -->
  <button type="button" class="btn btn-warning handle" data-toggle="modal" data-target="#editModal" id="<?php echo $v['id'];?>">
    EDIT
  </button>
  </td>
    </tr>
    <?php

    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
  </tbody>
</table>
</div>

<!-- The SQLModal -->
<div class="modal" id="sqlModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">SQL</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <span class="comMand"></span>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- The EDITModal -->
<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">SQL</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="post" action="admin.php">
      <input type="hidden" name="id" id="id">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="form-group">
        <label>TB_Name</label>
        <input type="text" class="form-control" id="tbname" name="tbname">
      </div>
      <div class="form-group">
        <label>SQL</label>
        <textarea class="form-control comMand" id="sql" rows="5" name="sql"></textarea>
      </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="updatesql_btn">บันทึก</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The INSERTModal -->
<div class="modal" id="InsertModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">SQL</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="post" action="admin.php">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="form-group">
        <label>TB_Name</label>
        <input type="text" class="form-control" id="tbname" name="tbname">
      </div>
      <div class="form-group">
        <label>SQL</label>
        <textarea class="form-control comMand" id="sql" rows="5" name="sql"></textarea>
      </div>

      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="insertsql_btn">บันทึก</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
if (isset($_POST['insertsql_btn'])) {
    insertsql();
}
function insertsql(){
    include 'db.php';
    //echo "insert";
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $tbname = isset($_POST['tbname']) ? $_POST['tbname'] : '';
    $sql = isset($_POST['sql']) ? $_POST['sql'] : '';
    $sql = addslashes($sql);
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT into command (name, tbname, command) VALUES ('$name', '$tbname', '$sql');"); 
        $stmt->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
if (isset($_POST['updatesql_btn'])) {
    updatesql();
}
function updatesql(){
    include 'db.php';
    //echo "insert";
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $tbname = isset($_POST['tbname']) ? $_POST['tbname'] : '';
    $sql = isset($_POST['sql']) ? $_POST['sql'] : '';
    $sql = addslashes($sql);
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("UPDATE command SET name = '$name' , tbname = '$tbname' , command = '$sql' where id = '$id';"); 
        $stmt->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>
</body>

<script>
$(document).ready(function(){
    $('.handle').on('click',function(){
        var user_id = this.id
        //alert (user_id)
        $.ajax({
            type:'POST',
            url:'jsoncommand.php?id=' + user_id,
            dataType: "json",
            data: '',
            success:function(v){
                    $('.comMand').text(v.command);
                    $('#name').val(v.name);
                    $('#tbname').val(v.tbname);
                    $('#id').val(v.id);
                    /* $('#userPhone').text(data.result.phone);
                    $('#userCreated').text(data.result.created);
                    $('.user-content').slideDown(); */
            }
        });
    });
});
</script>
</html>

    
