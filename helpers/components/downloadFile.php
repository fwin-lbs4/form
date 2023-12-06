<?php

function downloadFile($isLoggedIn, $currentUser = null)
{
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
