<?php

require_once "logout.php";

function nav($isLoggedIn)
{
  $ret = "<nav class='nav'>";
  $ret .= "<menu>";

  $ret .= "<li><a href='/form/'>Anmeldeformular</a></li>";

  if ($isLoggedIn === true) {
    $ret .= "<li><a href='/form/login.php'>User</a></li>";
  }

  $ret .= "<li>";
  $ret .= $isLoggedIn !== true ? "<a href='/form/login.php'>Login</a>" : logout($isLoggedIn);
  $ret .= "</li>";

  $ret .= "</menu>";
  $ret .= "</nav>";

  return $ret;
}
