<?php 
    require_once('essentials.php');
    session_start();
    session_destroy();
    redirect('index.php');