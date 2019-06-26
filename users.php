<?php 

  include('init.php');
  $user->session();
if($_SESSION['type']>=3){

  $design=new GUI();
  
  $design->header("Users of system");                                                                                                                                                                                                                                   
  $design->navigation('user');			                                                   
  $design->rightPanel();
  $design->print_users();
 
 //funkce zajištující db operaci aktualizace uživatelského účtu 
 $db->update_type()   ;}
 else{header("location: index.php");} 
?>