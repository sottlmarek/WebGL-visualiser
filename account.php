<?php 

  include('init.php');
  $post=isset($_POST["name"]) ? $_POST["name"] : null;
  $user->session();
  $design=new GUI();
  
  $design->header("Account Management");                                                                                                                                                                                                                                   
  $design->navigation($user->type);			                      
  $design->formUserEdit($_SESSION["id"]);                              
  $design->rightPanel();
  $design->help();
  $design->footer();
 
 //funkce zajištující db operaci aktualizace uživatelského účtu 
  $db->update_user($_SESSION["id"]);
        
?>