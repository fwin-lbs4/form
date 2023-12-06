<?php

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
