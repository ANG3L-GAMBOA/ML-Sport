<?php
require_once 'config.php';
require_once 'controllers/homecontroller.php';
$home = new Home();
$home->index();