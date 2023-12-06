<?php

function logout($isLoggedIn)
{
  if ($isLoggedIn !== true) return "";

  $ret = "<form method='POST' action='{$_SERVER['REQUEST_URI']}'>";

  $ret .= "<input type='hidden' name='logout' value='true' />";

  $ret .= "<button type='submit'>Logout</button>";

  $ret .= "</form>";

  return $ret;
}
