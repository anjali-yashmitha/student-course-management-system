<?php

session_start();
include "Utils/Util.php";

session_unset();
session_destroy();

$em = "Logged Out! 😥 ";
Util::redirect("login.php", "error", $em);