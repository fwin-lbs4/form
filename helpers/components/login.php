<?php

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
