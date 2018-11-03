<?php
include_once "session.php";
session_unset();
session_destroy();
Header("Location: index.php");
