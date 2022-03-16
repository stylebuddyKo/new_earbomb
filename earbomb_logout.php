<?php

session_start();

unset($_SESSION['user']);

header("Location:./earbomb_index.php");