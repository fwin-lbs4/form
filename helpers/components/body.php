<?php

function body($inner)
{
  $ret = "<body>";

  $ret .= "<header class='header'>";
  $ret .= "<img decoding='async' fetchpriority='high' src='assets/logo.svg' alt='Logo NCM' width='300' height='91' />";
  $ret .= "<h1>NCM.at - Hotel-First Digitalagentur</h1>";
  $ret .= "</header>";

  $ret .= implode("", $inner);

  $ret .= "</body>";

  return $ret;
}
