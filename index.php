<?php

require_once "helpers/shared.php";

if ($isPost) {
  writeUser($usersFile);

  if (isset($_FILES["file"]["size"]) && $_FILES["file"]["size"] > 0) {
    saveFile($_FILES["file"]);
  }
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
