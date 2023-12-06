<?php

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
