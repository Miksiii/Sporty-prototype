<?php 

session_start();

if (isset($_SESSION['user_id'])) 
{
  header('Location: http://localhost/www/sporty/dashboard.php');
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
        <h1>Get instant access now!</h1>
        <p>Start playing some sport.</p>
        <a href="register.php">Register now</a> if no account.
      </div>

      <?php 

      require 'core/User.php';

      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->login($email, $password);
      }

      ?>

      <form action="" method="post">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="text" class="form-control" name="password">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-success" value="Login">
        </div>
      </form>

    </div>
  </div>

</body>
</html>