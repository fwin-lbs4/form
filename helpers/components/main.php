<?php

function main($heading, $inner)
{
  $ret = "<main class='main'>";
  $ret .= "<article>";

  $ret .= "<h2>$heading</h2>";

  $ret .= implode("", $inner);

  $ret .= "</article>";
  $ret .= "</main>";

  return $ret;
}
