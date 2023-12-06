<?php

require_once "helpers/helpers.php";
require_once "helpers/form.php";
require_once "helpers/csv.php";
require_once "helpers/shared.php";

if ($isPost && $_FILES['file']['size'] > 0) {
  saveFile($_FILES["file"]);
}


$dom = document(
  [
    head("Anmeldeformular"),
    body(
      [
        nav($isLoggedIn),
        main(
          "Anmeldeformular",
          [
            form()
          ]
        )
      ]
    )
  ]
);

echo $dom;
