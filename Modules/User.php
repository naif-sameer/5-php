<?php
session_start();

require_once 'db.php';

// require_once './../utils/use_log.php';
// require('../utils/use_log.php');
// use function SuperConsole\dd;


use DB\Database;


function check_inputs(array $inputs)
{
  foreach ($inputs as $key => $value)
    if (empty($value)) {
      return "$key must be entered";
    }
    // check password
    elseif ($key === "password" && strlen($value) < 8) {
      return "$key must be greater than 8";
    }
  return null;
}

class User
{
  private $conn;
  public $success_message;

  public function __construct()
  {
    // connect to database;
    $this->conn = new Database('users', [
      "name" => "VARCHAR(255)",
      "email" => "VARCHAR(255)",
      "password" => "VARCHAR(255)",
    ]);
  }

  public function login($email, $password)
  {
    // check inputs
    $errors = check_inputs([
      "email" => $email, "password" => $password
    ]);

    if ($errors) {
      return $errors;
    }

    // get data from database by email
    $result = $this->conn->select()->where('email', $email)->get();

    if (!$result || count($result) === 0) {
      return 'Wrong email or password';
    }

    if ($result['password'] == $password) {

      $_SESSION['auth'] = true;
      $_SESSION['userID'] = $result['id'];

      // redirect to dashboard
      header('REFRESH:3;URL=dashboard.php');

      $this->success_message = 'Welcome man 😎. you are logged in successfully';
    } else {
      return 'Wrong email or password';
    }
  }

  public function register($name, $email, $password)
  {
    // check inputs
    $errors = check_inputs([
      "name" => $name,
      "email" => $email,
      "password" => $password
    ]);

    if ($errors) return $errors;

    // check if email exist in the database;
    $check_email = $this->conn->select(["email"])->where("email", $email)->get();

    if ($check_email && count($check_email) !== 0) {
      return "Email is already exist";
    }

    // add data to database
    $result = $this->conn->insert([
      "name" => $name,
      "email" => $email,
      "password" => $password
    ]);


    if ($result) {
      header('REFRESH:3;URL=dashboard.php');

      // get user id from database
      $user_id = $this->conn->select(["id"])->where("email", $email)->get()['id'];

      $_SESSION['auth'] = true;
      $_SESSION['userID'] = $user_id;

      $this->success_message = 'Hello there 😎.  your account has been created successfully';
    }
  }

  public function logout()
  {
    session_destroy();
    header('Location: index.php');
  }

  public function getName()
  {
    // get data from database by id
    $result = $this->conn->select()->where('id', $_SESSION['userID'])->get();

    return $result ? $result['name'] : "user not found";
  }
}

// $user = new User();

// dd($user->register('naif 3', time() .  'aldidsse@gmail.com', '12345678'));
// dd($user->getName());
