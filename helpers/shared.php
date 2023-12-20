<?php

require_once "csv.php";
require_once "components.php";

$isPost = $_SERVER['REQUEST_METHOD'] === "POST";

$usersFile = "users.csv";

if (!file_exists("users.csv")) {
  file_put_contents("users.csv", "salutation;name;date;mail;password;street;city;zip;state;phone;file;file");
}

if (!file_exists("session.json")) {
  file_put_contents("session.json", json_encode([]));
}

$isLoggedIn = verifyLogin($usersFile);

if (isset($_POST["logout"]) && $_POST["logout"] === "true") {
  $sessionId = $_COOKIE["session"] ?? "";
  $sessionUser = $_COOKIE["Session_User"] ?? $_POST["user"] ?? null;

  $sessions = json_decode(file_get_contents("session.json"), true);

  if (isset($sessions[$sessionUser])) {
    unset($sessions[$sessionUser]);
  }

  file_put_contents("session.json", json_encode($sessions));

  setcookie(
    "Session_User",
    $sessionUser,
    time() - 3600,
    $_SERVER['SERVER_NAME']
  );

  setcookie(
    "Session_Id",
    $sessionId,
    time() - 3600,
    $_SERVER['SERVER_NAME']
  );

  $isLoggedIn = false;
}

function verifyLogin($file)
{
  $isLoggedIn = false;

  $sessions = json_decode(file_get_contents("session.json"), true);
  $sessionId = $_COOKIE["Session_Id"] ?? uniqid();
  $sessionUser = $_COOKIE["Session_User"] ?? $_POST["user"] ?? null;

  if ($sessionId && $sessionUser) {
    $isLoggedIn = (isset($sessions[$sessionUser]) && $sessions[$sessionUser] === $sessionId);
  }

  $postPassword = $_POST["password"] ?? null;

  if ($isLoggedIn !== true && $sessionUser && $postPassword) {
    $user = getUser($sessionUser, $file);

    if ($user) {
      $isLoggedIn = password_verify($postPassword, $user["password"]);
      $sessions[$sessionUser] = $sessionId;
      file_put_contents("session.json", json_encode($sessions));
    }
  }

  if ($isLoggedIn) {
    setcookie(
      "Session_User",
      $sessionUser,
      time() + 3600,
      $_SERVER['SERVER_NAME']
    );

    setcookie(
      "Session_Id",
      $sessionId,
      time() + 3600,
      $_SERVER['SERVER_NAME']
    );
  }

  return $isLoggedIn;
}

$sessionUser = $_COOKIE["Session_User"] ?? $_POST["user"] ?? null;

$currentUser = $isLoggedIn && $sessionUser ? getUser($sessionUser, $usersFile) : null;
