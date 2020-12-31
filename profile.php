<?php 
$oldP ="";
$newP = "";
$confirmP ="";
$error1 = "";// this will be use for displaying error (Username or password is incorrect)
$error = "";// this will be use for displaying sql connect errors

if(isset($_POST['oldP'])){ /* this if checks is form is submitted by checking that $_POST['username'] is set or exists */
    var_dump('anjing');
    $newP = $_POST['newP'];
	$confirmP = $_POST['confirmP'];
	$oldP = $_POST['oldP'];
	if($newP == $confirmP){
        include 'connection.php'; /* this file contains variables used for connecting to database ($server,$username,$password,$dbname)*/
        $conn = new mysqli($server, $username, $password,$dbname);// this create connection
        var_dump('anjing1');
        if ($conn->connect_error) { //  this checks if there error connecting to server
	        $error = die("Connection failed: " . $conn->connect_error); // saves error  in $error
        } 
        // $user =  trim(htmlspecialchars($_POST['username']));/* this will trim(remove extra spaces) and remove html tags from username*/
        // $pass = trim(htmlspecialchars($_POST['password']));/* this will trim(remove extra spaces) and remove html tags from password*/
        $sql = "SELECT * FROM `users` WHERE password ='".$oldP."'";
        var_dump('anjing2');
        $result= $conn->query($sql);
        var_dump($result);
        if($result->num_rows < 0){
            $error = "your pass is wrong";
            var_dump('anjing4');
        }
        else {
            var_dump('anjing3');
            $sql = "UPDATE 'users' SET password = '".$oldP."' WHERE username = 'pradnyashita'";
            var_dump($sql);
            if($conn->query($sql)== true){
		   
			$sql = "select * from users where username='".$user."'";
			$result=$conn->query($sql);
			while($row = $result->fetch_assoc()){
				
		    $_SESSION['Name'] =  $row['username'];
			$_SESSION['Id'] = $row['Id'];
			$sql = "DELETE FROM ".$dbname.".`online` WHERE plrid=".$_SESSION["Id"];
			$conn->query($sql);
			$sql = "INSERT INTO ".$dbname.".`online`(`plrid`, `plrname`) VALUES (".$_SESSION['Id'].",'".$_SESSION['Name']."')";
			$conn->query($sql);
			
			
			// header("Location:online.php"); /* Redirect browser */
            exit();
			}		
			
}	
}
	}
	else {
		$error = "Passwords not matched!";
		}
	
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">    
    <title>Document</title>
</head>
<body>
    <div class="container">

   
<form action="" method= "post">
<div class="mb-3">
    <label  class="form-label">old Password</label>
    <input name="oldP" type="password" class="form-control" >
  </div>
<div class="mb-3">
    <label class="form-label"> new Password</label>
    <input name="newP"  type="password" class="form-control" >
  </div>

  <div class="mb-3">
    <label  class="form-label">confirm Password</label>
    <input name="confirmP" type="password" class="form-control" >
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>    
</div>
</body>
</html>









