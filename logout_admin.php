<?php

//start session
session_start();

//destroy session for remove the stored session variables
session_destroy();

//go to login.php
header('location:admin');

?>