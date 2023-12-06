<?php

require_once "form.php";

function head($title)
{
  $ret = "<head>";
  $ret .= "<meta charset='UTF-8' />";

  $ret .= "<meta name='name' content='Anmeldeformular' />";
  $ret .= "<meta name='author' content='Florian Windisch' />";
  $ret .= "<meta name='description' content='ILA-KPT_ÜBUNG1' />";

  $ret .= "<title>{$title}</title>";

  $ret .= "<link rel='preload' href='assets/logo.svg' as='image' />";
  $ret .= "<link rel='stylesheet' href='assets/style.css' />";

  $ret .= "</head>";
  return $ret;
};

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

function nav($isLoggedIn)
{
  $ret = "<nav class='nav'>";

  $ret .= "<menu>";

  $ret .= "<li><a href='/form/'>Anmeldeformular</a></li>";

  if ($isLoggedIn === true) {
    $ret .= "<a href='/form/login.php'>User</a>";
  }

  $ret .= "<li>";

  $ret .= $isLoggedIn !== true ? "<a href='/form/login.php'>Login</a>" : logout($isLoggedIn);

  $ret .= "</li>";

  $ret .= "</menu>";

  $ret .= "</nav>";

  return $ret;
}

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

function document($inner)
{
  $doc = "<!DOCTYPE html>";
  $doc .= "<html lang='de'>";
  $doc .= implode("", $inner);
  $doc .= "</html>";
  return $doc;
}
