<?php 

include 'initialize.php';

$myEventsList = $currentUser->getMyEvents($currentUser->getId());

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
          <h1>These are your events, <?php echo $currentUser->getUsername(); ?>!</h1>
          <hr>
          <p>
            <a href="eventCreate.php">Create</a> |
            <a href="editProfile.php">Edit</a> | 
            <a href="logout.php">Logout</a>
          </p>
          <p>
            <a href="dashboard.php">< Back</a>
          </p>
        </div>

        <?php 

        foreach($myEventsList as $myEvent)
        {
          ?> 

            <div class="alert alert-success">
              <h2><?php echo $myEvent['event_title']; ?></h2>
              <p>Date & time: <?php echo $myEvent['event_date']; ?> @ <?php echo $myEvent['event_time']; ?>h</p>
              <p>Players: <?php echo $myEvent['event_going']; ?>/<?php echo $myEvent['event_players']; ?></p>
              <a href="#" class="btn btn-default">Delete Event</a>
            </div>
            
          <?php
        }
        ?>

      </div>
    </div>
  </div>

</body>
</html>