<?php

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
