<?php 

session_start();
if (isset($_POST['submit'])){
    // var_dump($_FILES['image']);die;
    $namaGambar = $_FILES['image']['name'];
    $tmpname = $_FILES['image']['tmp_name']; //penyimpanan sementara 
    // var_dump($namaGambar);die;
    $eror = $_FILES['image']['error'];
    $size = $_FILES['image']['size']; 

 // cek apakah eror atau gak 

 if ($eror === 4){ // 4 artinya gambar tidak di upload, atau boleh tulis !$eror
  echo "<script> 
   alert ('harap upload foto');
   document.location.href = 'profile.php';
   </script>";
  return False ;
 }

 // cek ekstensi 

 $ekstensigambarValid = ['jpg','jpeg','png']; // ini ekstensi yang diperbolehkan 
 $ekstensifilegambar = explode('.', $namaGambar);
 $ekstensigambar = strtolower((end($ekstensifilegambar)));

 if (!in_array($ekstensigambar, $ekstensigambarValid)){

  echo "<script> 
   alert ('ekstensi gambar tidak valid');
   document.location.href = profile.php'; 
   </script>";
  return False ;

 }
 //  cek size foto 

 if ($size > 2000000){
  echo "<script> 
   alert ('ukuran size kebesaran');
   document.location.href = 'profile.php';
   </script>";
  return False ;
 }

 // jika lolos pengecekan, upload file
 // genetate nama gambar baru 

//  $namaGambarBaru  = uniqid();
//  $namaGambarBaru .- ".";
//  $namaGambarBaru .= $ekstensigambar;

 move_uploaded_file($tmpname, 'images/' . $namaGambar);

 include 'connection.php';
$conn = new mysqli($server, $username, $password,$dbname);// this create connection
$sql = "SELECT * from users where username='".$_SESSION['Name']."'";
$result=$conn->query($sql);
                // var_dump($result);die;
$row = $result->fetch_assoc();

$pass = $row['password'];
$id = $row['Id'] ;  
$image= $row['image'];
            // var_dump($image);die;
$sql = "DELETE FROM ".$dbname.".`users` WHERE id='".$id."'";
$conn->query($sql);
$sql = "INSERT INTO ".$dbname.".`users`(`id`, `username`, `password`, `image`) VALUES ('".$id."', '".$_SESSION['Name']."', '". $pass."', '". $namaGambar."')";
$conn->query($sql);
//  return $namaGambarBaru;
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

    <h1>PROFILE</h1>
    <div class="card" style="width: 18rem;">

    <?php
    include 'connection.php';
    $conn = new mysqli($server, $username, $password,$dbname);// this create connection
    $sql = "SELECT * from users where username='".$_SESSION['Name']."'";
            $result=$conn->query($sql);
                // var_dump($result);die;
			$row = $result->fetch_assoc();
				
		        
            $image= $row['image'];
            // var_dump($image);die;
    
    ?>
  <img src="images/<?= $image;?>" class="card-img-top" alt="ini foto bambang">
  
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Change Image
</button>
  <div class="card-body">
     </div>
     <p class="card-text" style="margin-left: 16px">Nama: <?= $_SESSION['Name']?></p>
  <div class="card-body"> 
    <a href="online.php" class="btn btn-secondary">Back</a>
    <a href="editProfile.php" class="btn btn-primary">Edit Profile</a>
  </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Change Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="" method= "post" enctype="multipart/form-data">
    <label class="form-label">Change Image</label>
    <input name="image" type="file" class="form-control" >
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
-->
</html>









