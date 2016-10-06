<?php 

  require 'core/User.php';

  if($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $facebookUrl = $_POST['facebookUrl'];

    $user = new User();
    $user->register($username, $email, $password, $phone, $facebookUrl);
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

  <div class="container">
    <div class="col-md-12">
      <div class="jumbotron">
        <h1>Register now</h1>
        <p>It's free to join anytime!</p>
        <a href="index.php">< Back</a>
      </div>
    </div>

    <form action="" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="text" class="form-control" name="password">
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" name="phone">
      </div>
      <div class="form-group">
        <label for="facebookUrl">FacebookUrl</label>
        <input type="text" class="form-control" name="facebookUrl">
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-info" value="Register">
      </div>
    </form>

  </div>

</body>
</html>