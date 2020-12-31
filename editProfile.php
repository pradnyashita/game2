<?php 
session_start();
// var_dump($_SESSION['Name']);die;
$oldP ="";
$newP = "";
$confirmP ="";
$error1 = "";// this will be use for displaying error (Username or password is incorrect)
$error = "";// this will be use for displaying sql connect errors

if(isset($_POST['oldP'])){ /* this if checks is form is submitted by checking that $_POST['username'] is set or exists */
    $newP = $_POST['newP'];
	$confirmP = $_POST['confirmP'];
	$oldP = $_POST['oldP'];
	if($newP == $confirmP){
        include 'connection.php'; /* this file contains variables used for connecting to database ($server,$username,$password,$dbname)*/
        $conn = new mysqli($server, $username, $password,$dbname);// this create connection
        if ($conn->connect_error) { //  this checks if there error connecting to server
	        $error = die("Connection failed: " . $conn->connect_error); // saves error  in $error
        } 
        // $user =  trim(htmlspecialchars($_POST['username']));/* this will trim(remove extra spaces) and remove html tags from username*/
        // $pass = trim(htmlspecialchars($_POST['password']));/* this will trim(remove extra spaces) and remove html tags from password*/
        $sql = "SELECT * FROM `users` WHERE username ='".$_SESSION['Name']."'";
        $result= $conn->query($sql);
        if($result->num_rows < 0){
            $error = "your pass is wrong";
        }
        else {
            // var_dump('anjing3');

            $sql = "SELECT * from users where username='".$_SESSION['Name']."'";
            $result=$conn->query($sql);
                // var_dump($result);die;
			$row = $result->fetch_assoc();
				
		        
			$id= $row['Id'];
			$sql = "DELETE FROM ".$dbname.".`users` WHERE id='".$id."'";
			$conn->query($sql);
			$sql = "INSERT INTO ".$dbname.".`users`(`id`, `username`, `password`) VALUES ('".$id."','".$_SESSION['Name']."','". $newP."')";
            $conn->query($sql);
            header("Location:online.php"); /* Redirect browser */
            // $sql = "UPDATE `users` SET password = '".$newP."' WHERE username = '".$_SESSION['Name']."'";
            // $conn->query($sql);
            // var_dump($result->num_rows);die;

            // $sql = "DELETE FROM ".$dbname.". `users` WHERE username ='".$_SESSION["Name"]."'";
			// $conn->query($sql);
			// $sql = "INSERT INTO ".$dbname.".`users`(`plrid`, `username`, ``) VALUES (".$_SESSION['Id'].",'".$_SESSION['Name']."')";
			// $conn->query($sql);
            // if($conn->query($sql)== true){
            //     var_dump('anjing6');
			//     // $sql = "select * from users where username='".$user."'";
            //     $result=$conn->query($sql);
            //     // var_dump($result);die;
			//     while($row = $result->fetch_assoc()){
				
		    //     $_SESSION['Name'] =  $row['username'];
			//     $_SESSION['Id'] = $row['Id'];
			    // $sql = "DELETE FROM ".$dbname.".`online` WHERE plrid=".$_SESSION["Id"];
			    // $conn->query($sql);
			    // $sql = "INSERT INTO ".$dbname.".`online`(`plrid`, `plrname`) VALUES (".$_SESSION['Id'].",'".$_SESSION['Name']."')";
			    // $conn->query($sql);
			
			
			
            // exit();
			// }		
			
// }	
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
<div class="container" style="margin-top: 20px">
<a href="profile.php" class="btn btn-secondary">Back</a>
</div>  
</div>
</body>
</html>









