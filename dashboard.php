<?php 

include 'initialize.php';

$sportsList = $currentUser->getSportsList();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron">
          <h1>Welcome back, <?php echo ucfirst($currentUser->getUsername()); ?>!</h1>
          <hr>
          <p>Email: <?php echo $currentUser->getEmail();?></p>
          <p>Phone: <?php echo $currentUser->getPhone();?></p>
          <p>Facebook: <?php echo $currentUser->getFacebookUrl();?></p>
          <hr>
          <p>
            <a href="myEvents.php">My events</a> |
            <a href="eventCreate.php">Create</a> |
            <a href="editProfile.php">Edit</a> | 
            <a href="logout.php">Logout</a>
          </p>
        </div>

        <?php 

        foreach($sportsList as $category)
        {
          ?>
          <div class='alert alert-info'>
            <h2><?php echo $category['sport_name']; ?></h2>
            <p><?php echo $category['sport_description']; ?></p>
            <p><b>Events: <?php echo $category['sport_events'];?></b></p>
            <hr>
            <a href="events.php?filter=<?php echo $category['sport_name']; ?>" class="btn btn-info">See all events ></a>
          </div>
          <?php 
        }

        ?>

      </div>
    </div>
  </div>

</body>
</html>