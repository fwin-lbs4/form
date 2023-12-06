<?php

function getUsers($file)
{
  if (!file_exists($file)) return null;

  $ret = null;

  $handle = fopen($file, "r");

  try {
    $temp = [];

    while (($data = fgetcsv($handle, 1000, ";")) !== false) {
      $temp[] = $data;
    }

    $headings = array_shift($temp);

    foreach ($temp as $index => $value) {
      $ret[$index] = [];

      foreach ($value as $key => $val) {
        $ret[$index][$headings[$key]] = $val;
      }
    }
  } catch (\Throwable $th) {
    fclose($handle);
    $ret = null;
  }

  if (
    is_array($ret)
    && count($ret) >= 1
    && !is_array($ret[0])
  ) {
    $ret = null;
  }

  return $ret;
}

function getUser($name, $file) {
  if ($name === false) {
    setcookie(
      "Session_User",
      "",
      time() - 3600,
      $_SERVER['SERVER_NAME']
    );

    setcookie(
      "Session_Password",
      "",
      time() - 3600,
      $_SERVER['SERVER_NAME']
    );

    return null;
  }

  $users = getUsers($file);

  $user = null;

  foreach ($users as $key => $value) {
    if ($value["name"] !== $name) continue;

    $user = $value;

    break;
  }

  return $user;
}

function prepareCurrentUser($post): array {
  $user = $post;

  $user["password"] = password_hash($user["password"], PASSWORD_DEFAULT);

  return $user;
}

function saveFile($file) {
  $directory = "files/";
  $targetFile = $directory . basename($file["name"]);
  move_uploaded_file($file['tmp_name'], $targetFile);
}

function writeUser($file)
{
  $users = getUsers($file);

  $users = $users === null ? [] : $users;

  $newUser = $_POST;

  if ($_FILES['file']['size'] > 0) {
    $newUser["file"] = $_FILES['file']['name'];
  }

  $users[] = [...prepareCurrentUser($newUser)];

  $header = array_keys($users[0]);
  $header[] = "file";

  $tmpUsers = [];

  foreach ($users as $key => $val) {
    $tmpUsers[$key] = [];

    foreach ($header as $index) {
      $tmpUsers[$key][$index] = $val[$index] ?? ""; 
    }
  }

  $users = $tmpUsers;

  $handle = fopen($file, "w");

  try {
    fputcsv($handle, $header, ";");
  } catch (\Throwable $th) {
    fclose($handle);
  }

  $handle = fopen($file, "a");

  try {
    //code...
    foreach ($users as $user) {
      fputcsv($handle, $user, ";");
    }
  } catch (\Throwable $th) {
    fclose($handle);
  }

  // var_dump($users);
  // die();

  return $users;
}
