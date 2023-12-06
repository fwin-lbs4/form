<?php

function form()
{
  $ret = "<form method='POST' action='{$_SERVER['REQUEST_URI']}' enctype='multipart/form-data' id='form'>";
  $ret .= "<fieldset>";
  $ret .= "<legend>Konto</legend>";

  $ret .= "<div>";
  $ret .= "<span>Anrede</span>";

  $ret .= "<div>";
  $ret .= "<div>";
  $ret .= "<input type='radio' value='none' name='salutation' id='none' checked autofocus />";
  $ret .= "<label for='none'>Keine</label>";
  $ret .= "</div>";


  $ret .= "<div>";
  $ret .= "<input type='radio' value='mr' name='salutation' id='mr' />";
  $ret .= "<label for='mr'>Herr</label>";
  $ret .= "</div>";

  $ret .= "<div>";
  $ret .= "<input type='radio' value='ms' name='salutation' id='ms' />";
  $ret .= "<label for='ms'>Frau</label>";
  $ret .= "</div>";
  $ret .= "</div>";
  $ret .= "</div>";

  $ret .= "<div>";
  $ret .= "<label for='name'>Name</label>";
  $ret .= "<input type='text' name='name' id='name' required placeholder='Name' />";
  $ret .= "</div>";

  $ret .= "<div>";
  $ret .= "<label for='date'>Geburtstag</label>";
  $ret .= "<input type='date' name='date' id='date' />";
  $ret .= "</div>";

  $ret .= "<div>";
  $ret .= "<label for='mail'>E-Mail</label>";
  $ret .= "<input type='email' name='mail' id='mail' placeholder='E-Mail' />";
  $ret .= "</div>";

  $ret .= "<div>";
  $ret .= "<label for='password'>Passwort</label>";
  $ret .= "<input type='password' name='password' id='password' required placeholder='Passwort' />";
  $ret .= "</div>";
  $ret .= "</fieldset>";

  $ret .= "<fieldset>";
  $ret .= "<legend>Adresse</legend>";

  $ret .= "<div>";
  $ret .= "<label for='street'>Straße</label>";
  $ret .= "<input type='text' name='street' id='street' placeholder='Straße' />";
  $ret .= "</div>";

  $ret .= "<div>";
  $ret .= "<label for='city'>Wohnort</label>";
  $ret .= "<input type='text' name='city' id='city' required placeholder='Wohnort' />";
  $ret .= "</div>";

  $ret .= "<div>";
  $ret .= "<label for='zip'>PLZ</label>";
  $ret .= "<input type='number' name='zip' id='zip' placeholder='5020' min='0' max='9999' />";
  $ret .= "</div>";

  $ret .= "<div>";
  $ret .= "<label for='state'>Bundesland</label>";
  $ret .= "<select name='state' id='state' required>";
  $ret .= "<option value='' selected>Bundesland</option>";
  $ret .= "<option value='salzburg'>Salzburg</option>";
  $ret .= "<option value='vorarlberg'>vorarlberg</option>";
  $ret .= "<option value='steiermark'>steiermark</option>";
  $ret .= "<option value='kaernten'>Kärnten</option>";
  $ret .= "<option value='wien'>wien</option>";
  $ret .= "<option value='burgenland'>burgenland</option>";
  $ret .= "<option value='oberoesterreich'>Oberösterreich</option>";
  $ret .= "<option value='niederoesterreich'>Niederösterreich</option>";
  $ret .= "<option value='tirol'>Tirol</option>";
  $ret .= "</select>";
  $ret .= "</div>";

  $ret .= "<div>";
  $ret .= "<label for='phone'>Telefonnummer</label>";
  $ret .= "<input type='tel' name='phone' id='phone' placeholder='Telefonnummer' pattern='(0|\+)([0-9]|\s|-){9,16}' />";
  $ret .= "</div>";
  $ret .= "</fieldset>";

  $ret .= "<fieldset>";
  $ret .= "<legend>Datei</legend>";
  $ret .= "<div>";
  $ret .= "<label for='file'>Datei</label>";
  $ret .= "<input type='file' name='file' id='file' />";
  $ret .= "</div>";
  $ret .= "</fieldset>";

  $ret .= "<button type='submit'>Submit</button>";
  $ret .= "<button type='reset'>Reset</button>";
  $ret .= "</form>";

  return $ret;
}

function result()
{
  $isPost = $_SERVER['REQUEST_METHOD'] !== "POST";
  if ($isPost) return "";
  $ret = "<pre>";
  foreach ($_POST as $key => $value) {
    if (empty($value)) continue;
    $ret .= "{$key}: {$value}\n";
  }
  $ret .= "</pre>";
  return $ret;
}

function showUsers($users = null, $hidePassword = true)
{
  if ($users === null) {
    return "";
  }

  $ret = "<div>";

  foreach ($users as $index => $arr) {
    $ret .= "<pre>";

    foreach ($arr as $key => $val) {
      if (empty($val)) continue;

      if ($key === "password" && $hidePassword !== false) {
        $val = "***";
      }

      $ret .= "{$key}: {$val}";

      if (array_key_last($arr) !== $key) {
        $ret .= "\n";
      }
    }

    $ret .= "</pre>";
  }

  $ret .= "</div>";

  return $ret;
}

function login($isLoggedIn, $userFile)
{
  $ret = "";

  if (!$isLoggedIn) {
    $ret .= "<h2>User not logged in!</h2>";
    $ret .= "<form method='POST' action='{$_SERVER['REQUEST_URI']}'>";

    $ret .= "<fieldset>";
    $ret .= "<legend>Konto</legend>";

    $ret .= "<div>";
    $ret .= "<label for='user'>Name</label>";
    $ret .= "<input type='text' name='user' id='user' required placeholder='Name' />";
    $ret .= "</div>";

    $ret .= "<div>";
    $ret .= "<label for='password'>Passwort</label>";
    $ret .= "<input type='password' name='password' id='password' required placeholder='Passwort' />";
    $ret .= "</div>";

    $ret .= "</fieldset>";

    $ret .= "<button type='submit'>Submit</button>";
    $ret .= "<button type='reset'>Reset</button>";

    $ret .= "</form>";
  }

  return $ret;
}

function logout($isLoggedIn)
{
  if ($isLoggedIn !== true) return "";

  $ret = "<form method='POST' action='{$_SERVER['REQUEST_URI']}'>";

  $ret .= "<input type='hidden' name='logout' value='true' />";

  $ret .= "<button type='submit'>Logout</button>";

  $ret .= "</form>";

  return $ret;
}

function userInfo($isLoggedIn, $currentUser)
{
  $ret = "";

  if (
    $isLoggedIn !== true
    || !isset($currentUser)
  ) {
    return $ret;
  }

  $user = $currentUser;

  $ret .= "<pre>";

  foreach ($user as $key => $value) {
    if (empty($value)) continue;

    $value = $key === "password" ? "***" : $value;

    $ret .= "{$key}: {$value}" . (array_key_last($user) !== $key ? "\n" : "");
  }

  $ret .= "</pre>";

  return $ret;
}

function downloadFile($isLoggedIn, $currentUser = null) {
  $ret = "";

  if (
    $isLoggedIn !== true
    || !isset($currentUser)
    || !isset($currentUser["file"])
  ) {
    return $ret;
  }

  $http = "http://";

  $fileDir = "{$_SERVER['SERVER_NAME']}/form/files/";

  $file = $currentUser["file"];

  $ret .= "<a download='{$file}' href='{$http}{$fileDir}{$file}'>{$file}</a>";

  return $ret;
}