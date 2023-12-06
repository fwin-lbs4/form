<?php

require_once "helpers/shared.php";

$dom = document(
  [
    head($isLoggedIn ? "User" : "Login"),
    body(
      [
        nav($isLoggedIn),
        main(
          $isLoggedIn ? "User" : "Login",
          [
            login($isLoggedIn, $usersFile),
            userInfo($isLoggedIn, $currentUser),
            downloadFile($isLoggedIn, $currentUser),
            logout($isLoggedIn)
          ]
        )
      ]
    )
  ]
);

echo $dom;
