<?php
include('init.php');
$user->session();
isset($_GET["id"]) ? $_GET["id"] : null;
isset($_POST["content"]) ? $_POST["content"] : null;
isset($_POST["name"]) ? $_POST["name"] : null;
$design=new GUI();
$design->header("3D vizuaisation - Home");                                                                                                                                                                                                                                   
$design->navigation($user->type);
$design->welcomeScreen();
$design->rightPanel($db);
 
$design->footer('no_index');              
 


?>