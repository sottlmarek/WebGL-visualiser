<?php

include('init.php');
$user->session();

if($_SESSION['type']>=2){
$design=new GUI();
$design->header("New Category");                                                                                                                                                                                                                                   
$design->navigation('user');                                              
$design->rightPanel();
$design->formADDcat();
$design->footer();


$db->add_category() ;   }
else{header("location: index.php");} 
?>