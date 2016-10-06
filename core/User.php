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
}

