<?php
include('init.php');
//session
$user->session();
//ošetření get promněnných
isset($_GET["id"]) ? $_GET["id"] : null;
isset($_POST["content"]) ? $_POST["content"] : null;
isset($_POST["name"]) ? $_POST["name"] : null;
//layout
$design=new GUI();
$design->header("Main scene",$_GET["id"]);                                                                                                                                                                                                                                   
$design->navigation('user');
$design->glScene();
$design->filter();
$design->rightPanel($db);
$design->like();
$design->who_inserted_this();
$design->tweet();
$design->counter($db);
$design->infopanel($db);
$design->help();
$design->layer_window();
$design->texture_window(); 
$design->footer('model');              

//databázové operace přidání návštevy a přidání popisku
$db->add_visit($_GET["id"]);
$db->update_description();   


?>