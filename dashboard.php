<?php
session_start();

// check if the user logged in;
if (!isset($_SESSION['auth'])) {
  header('Location: login.php');
}
