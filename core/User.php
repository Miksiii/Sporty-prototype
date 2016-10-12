<?php 

require_once 'DBAccess.php';

class User 
{
  private $id; 
  private $username;
  private $email;
  private $password;
  private $phone;
  private $facebookUrl;
  private $db;

  public function __construct() 
  {
    $this->db = new DBAccess();
    $this->db = $this->db->connect();
  }

  public function getId(){
    return $this->id;
  }

  public function setId($id){
    $this->id = $id;
  }

  public function getUsername(){
    return $this->username;
  }

  public function setUsername($username){
    $this->username = $username;
  }

  public function getEmail(){
    return $this->email;
  }

  public function setEmail($email){
    $this->email = $email;
  }

  public function getPassword(){
    return $this->password;
  }

  public function setPassword($password){
    $this->password = $password;
  }

  public function getPhone(){
    return $this->phone;
  }

  public function setPhone($phone){
    $this->phone = $phone;
  }

  public function getFacebookUrl(){
    return $this->facebookUrl;
  }

  public function setFacebookUrl($facebookUrl){
    $this->facebookUrl = $facebookUrl;
  }

  public function getDb(){
    return $this->db;
  }

  public function setDb($db){
    $this->db = $db;
  }  

  public function register($username, $email, $password, $phone, $facebookUrl)
  {
    $sql = "
      INSERT INTO users 
      (user_id, user_name, user_email, user_password, user_phone, user_facebookUrl)
      VALUES 
      (NULL, :username, :email, :password, :phone, :facebookUrl)
    ";

    $query = $this->db->prepare($sql);

    $query->bindParam(':username', $username);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->bindParam(':phone', $phone);
    $query->bindParam(':facebookUrl', $facebookUrl);

    $query->execute();
  }

  public function login($email, $password)
  {
    $sql = "
      SELECT * FROM Users WHERE user_email = :email AND user_password = :password
    ";
    $query = $this->db->prepare($sql);

    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);

    $query->execute();
    
    if($query->rowCount() == 1) // ulogovan
    {
      $foundedUser = $query->fetch();
      session_start();
      $_SESSION['user_id'] = $foundedUser['user_id'];
      header('Location: http://localhost/www/sporty/dashboard.php');
    } else 
    {
      echo "<div class='alert alert-warning'>Incorrect username/password.</div>";
    }
  }

  public function setUserDetails($id)
  {
    $sql = "
      SELECT * FROM Users 
      WHERE user_id = :id 
    ";

    $query = $this->db->prepare($sql);
    $query->bindParam(':id', $id);
    $query->execute();

    if($query->rowCount() == 1)
    {
      $currentUser = $query->fetch();

      $this->id = $currentUser['user_id'];
      $this->username = $currentUser['user_name'];
      $this->email = $currentUser['user_email'];
      $this->password = $currentUser['user_password'];
      $this->phone = $currentUser['user_phone'];
      $this->facebookUrl = $currentUser['user_facebookUrl'];
    }
  }

  public function editProfile($username, $email, $password, $phone, $facebookUrl)
  {
    $sql = "
      UPDATE users 
      SET 
      user_name = :username, 
      user_email = :email, 
      user_password = :password, 
      user_phone = :phone, 
      user_facebookUrl = :facebookUrl 
      WHERE 
      user_id = :id
    ";

    $query = $this->db->prepare($sql);

    $query->bindParam(':username', $username);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->bindParam(':phone', $phone);
    $query->bindParam(':facebookUrl', $facebookUrl);
    $query->bindParam(':id', $this->id);

    $query->execute();
    $this->setUserDetails($this->id);

    echo "<div class='alert alert-success'>Successfuly udated.</div>";
  }

  public function getSportsList() 
  {
    $sql = "
      SELECT * FROM sports
    ";

    $query = $this->db->prepare($sql);
    $query->execute();

    return $query->fetchall();
  }

  public function eventCreate($sportName, $title, $date, $time, $players)
  {
    $sql = "
      INSERT INTO 
      events 
      (event_id, user_id, sport_name, event_title, event_date, event_time, event_players, event_going)
      VALUES 
      (NULL, :user_id, :sport_name, :event_title, :event_date, :event_time, :event_players, 0)
    ";

    $query = $this->db->prepare($sql);

    $query->bindParam(':user_id', $this->id);
    $query->bindParam(':sport_name', $sportName);
    $query->bindParam(':event_title', $title);
    $query->bindParam(':event_date', $date);
    $query->bindParam(':event_time', $time);
    $query->bindParam(':event_players', $players);

    $query->execute();
    $this->updateNumberOfEvents($sportName);

    echo "<div class='alert alert-success'>Successufuly created event</div>";
  }

  public function updateNumberOfEvents($sport)
  {
    $sql = "
      UPDATE sports 
      SET sport_events = sport_events + 1
      WHERE sport_name = :sport
    ";

    $query = $this->db->prepare($sql);
    $query->bindParam(':sport', $sport);
    $query->execute();
  }

  public function getEventsList($filter)
  {
    $sql = "
      SELECT * FROM events 
      JOIN users 
      ON users.user_id = events.user_id 
      WHERE events.sport_name = :filter
    ";

    $query = $this->db->prepare($sql);
    $query->bindParam(':filter', $filter);
    $query->execute();

    return $query->fetchall();
  }

  public function getMyEvents($id)
  {
    $sql = "
      SELECT * FROM events 
      WHERE user_id = :id
    ";

    $query = $this->db->prepare($sql);
    $query->bindParam(':id', $id);
    $query->execute();

    return $query->fetchall();
  }

  public function eventGo($eventID)
  {
    $sql = "
      UPDATE events 
      SET event_going = event_going + 1 
      WHERE event_id = :eventID
    ";

    $query = $this->db->prepare($sql);
    $query->bindParam(':eventID', $eventID);
    $query->execute();
  }

  public function eventLeave($eventID)
  {
    $sql = "
      UPDATE events 
      SET event_going = event_going - 1 
      WHERE event_id = :eventID
    ";

    $query = $this->db->prepare($sql);
    $query->bindParam(':eventID', $eventID);
    $query->execute();
  }  
}

