<?php
include('config.php');
session_start();
if(isset($_SESSION['username'])){
    header('Location: something.php');
}else{
 if(isset($_POST['login'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $sql="SELECT * FROM users WHERE username='$username' && password='$password'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $username=$row['username'];
                $_SESSION['username']=$username;
                $sql="UPDATE users SET status='online' WHERE username='$username'";
                mysqli_query($conn,$sql);
                header('Location:./something.php');
            }
        }else{
            
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="text-center mb-4">Login</h2>
        <form action='./' method='POST'>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name='username' placeholder="Enter your username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name='password' placeholder="Enter your password" required>
          </div>
          <button type="submit" class="btn btn-primary" name='login'>Login</button>
        </form>
      </div>
    </div>
  </div>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
