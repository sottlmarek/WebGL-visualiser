<?php
include('init.php');
//kontrola akcí
$action=isset($_GET["action"]) ? $_GET["action"] : null;
//layout metody
$design=new GUI();
$design->header("3D visualization");                                                                                                                                                                                                                                   
$design->navigation('no_user');
$design->welcomeScreen();
$design->rightPanel('index');
$design->footer('index');
//provedení akcí
if($action=="reg")$db->register();
if($action=="validate")$db->login(); 
if($action=="logout")$db->ok("Odlášení bylo úspěšné");   
              
?>