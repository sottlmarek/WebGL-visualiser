<?php
include('init.php');
$user->session();
if($_SESSION['type']>=2){


isset($_POST["name"]) ? $_POST["name"] : null;
isset($_GET["action"]) ? $_GET["action"] : null;
$design=new GUI();
$design->header("New Model");                                                                                                                                                                                                                                  
$design->navigation('user');
//speciální formulář generovaný z databáze pro tagy		                      
$design->genFormCategory();                            
$design->rightPanel();




$design->footer(); 

$db->fill_tags_models_category();   }
else{header("location: index.php");} 
      
?>