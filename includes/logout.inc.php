<?php

session_start();
//Delets all values in session 
session_unset();
//
session_destroy();
header("Location: ../index.php");