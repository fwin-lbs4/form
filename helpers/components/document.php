<?php

function document($inner)
{
  $doc = "<!DOCTYPE html>";
  $doc .= "<html lang='de'>";

  $doc .= implode("", $inner);

  $doc .= "</html>";

  return $doc;
}
