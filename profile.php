<?php 

session_start();
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

   
    <div class="card" style="width: 18rem;">
  <img src="images/default.jpg" class="card-img-top" alt="ini foto bambang">
  <div class="card-body">
    <h5 class="card-title">Profile</h5>
     </div>
     <p class="card-text" style="margin-left: 16px">Nama: <?= $_SESSION['Name']?></p>
  <div class="card-body"> 
    <a href="online.php" class="btn btn-secondary">Back</a>
    <a href="editProfile.php" class="btn btn-primary">Edit Profile</a>
  </div>
</div>
</div>
</body>
</html>









