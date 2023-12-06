<?php

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
}
