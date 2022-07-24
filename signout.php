<?php
include_once 'inc.php';
@session_destroy();
header('location: index.php');