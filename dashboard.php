<?php 

require 'core/User.php';

session_start();

if(!isset($_SESSION['user_id'])) 
{
  header('Location: http://localhost/www/sporty/index.php');
}

$currentUser = new User();
$currentUser->setUserDetails($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <h1>Hello welcome to dashboard!</h1>
  <p>Welcome back, <?php echo $currentUser->getEmail();?></p>
</body>
</html>