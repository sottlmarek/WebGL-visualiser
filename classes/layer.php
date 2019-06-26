<?php
Class Layer
{ 
function __construct(){
                                  

}
public function error($text){
                                  echo '<script>$(\'<div  class="alert"><img src="images/alert.png">&nbsp;'.$text.'</div>\').dialog(
                                  {resizable: false,show: \'drop\', hide: \'drop\', buttons: {Ok: function() {$( this ).dialog( "close" );}}});</script>';
}

public function ok($text){
                                  echo '<script>$(\'<div  class="alert"><img src="images/ok.png">&nbsp;'.$text.'</div>\').dialog(
                                  {resizable: false,show: \'drop\', hide: \'drop\', buttons: {Ok: function() {$( this ).dialog( "close" );}}});</script>';
                            }


public function upload_layer(){
                  $action=isset($_GET["action"]) ? $_GET["action"] : null;
                  $layer_name=isset($_POST["layer_name"]) ? $_POST["layer_name"] : null;
                  $file=isset($_POST["file"]) ? $_POST["file"] : null;
                  $id=isset($_GET["id"]) ? $_GET["id"] : null;
                  
                  $file_post=isset($_FILES["file"]["name"]) ? $_FILES["file"]["name"] :null ;
                  $file_name = $layer_name.$id.".dae";
                  $file = isset($_FILES["file"]["tmp_name"]) ? $_FILES["file"]["tmp_name"] : null;
                  //$action = $_GET["action"];

                  if ($action == "send" && $file_name!="" && $layer_name!="")
                  {
                      if (move_uploaded_file($file, "../filebase/$file_name"))
                          {
                          chmod ("../filebase/$file_name", 0646);
                          echo "<p id='green'>Collada soubor ".$file_post." byl importován</p>";
                          
                           $dotaz = "INSERT INTO layer (name,id_model) VALUES ('".$layer_name."',".$id.");";
                           mysql_query($dotaz);
                          
                          }
                      else
                          {
                          echo "<p id='red'>3D soubor se nepodařilo importovat</p>";
                          }
                  }
                  if ($action == "send" && $file_name=="") {echo "<p id='red'>Vyberte soubor</p>";}
                  if ($action == "send" && $layer_name=="") {echo "<p id='red'>Pojmenujte vrstvu</p>";}
}


public function upload_texture(){
                          $action=isset($_GET["action"]) ? $_GET["action"] : null;
                          $file_name = isset($_FILES["file"]["name"]) ? $_FILES["file"]["name"]:null;
                          $file = isset($_FILES["file"]["tmp_name"]) ? $_FILES["file"]["tmp_name"]:null;
                          $send = isset($_GET["action"]) ? $_GET["action"]:null;
                          
                      if ($action == "send" && $file_name!="")
                      {
                          if (move_uploaded_file($file, "../filebase/$file_name"))
                              {
                              chmod ("../filebase/$file_name", 0646);
                              echo "<p id='green'>Textura $file_name byla nahrána na server</p>";
                              }
                          else
                              {
                              echo "<p id='red'>Texturu se nepodařilo nahrát</p>";
                              }
                      } ;
                      
                      if ($action == "send" && $file_name=="") {echo "<p id='red'>Vyberte soubor</p>";}
                      
}

}


?>