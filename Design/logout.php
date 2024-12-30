<?php 
    require_once('../admin/essentials.php');
    session_start();
    session_destroy();
    redirect('index.php');