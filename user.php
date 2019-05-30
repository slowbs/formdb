    
<?php 
	include('functions.php');
    if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
    header('location: login.php');
    exit();
    }
    $id = $_SESSION['user']['id'];
    $duck = $_SESSION['user']['username'];
    $user_type = $_SESSION['user']['user_type'];

    echo $duck ." <br> " . $user_type . "<br>";
?>
    <a href="login.php?logout='1'">ออกจการะบบ</a>
