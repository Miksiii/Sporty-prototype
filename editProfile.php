<?php 

include 'initialize.php';

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
        <h1>Edit your profile</h1>
        <p>Edit your profile now and play some sport.</p>
        <a href="index.php">< Back</a>
      </div>

      <?php 

      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $facebookUrl = $_POST['facebookUrl'];

        $currentUser->editProfile($username, $email, $password, $phone, $facebookUrl);
      }

      ?>

      <form action="" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" value="<?php echo $currentUser->getUsername(); ?>">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" value="<?php echo $currentUser->getEmail(); ?>">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="text" class="form-control" name="password" value="<?php echo $currentUser->getPassword(); ?>">
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="text" class="form-control" name="phone" value="<?php echo $currentUser->getPhone(); ?>">
        </div>
        <div class="form-group">
          <label for="facebookUrl">FacebookUrl</label>
          <input type="text" class="form-control" name="facebookUrl" value="<?php echo $currentUser->getFacebookUrl(); ?>">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-info" value="Edit profile">
        </div>
      </form>

    </div>
  </div>

</body>
</html>