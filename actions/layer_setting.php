<?php
include("..\init.php");
$id=isset($_GET["id"]) ?  $_GET["id"] : null;
$action= isset($_GET["action"]) ?  $_GET["action"] : null;
echo '
<html>  
  <link rel="stylesheet" href="../design.css">
  <link rel="stylesheet" href="../jquery/tipTip.css"> 
  <link rel="stylesheet" href="../jquery/form.css">        
  <link rel="stylesheet" href="../jquery/lionbars.css">                                                                                 
  <link rel="stylesheet" href="../jquery/themes/base/jquery.ui.all.css">
  <link rel="stylesheet" href="../jquery/jQuery.css">                                                                         	  
  <head>    
    <title>import     
    </title>    
    <meta http-equiv="content-type" content="text/html; charset=utf-8">  
  </head>  
  <body>';
  if($action<>'send'){echo'    
    <form action="layer_setting.php?action=send&id='.$id.'" method="post">      
      <table>
      
      '  ;
      
      $query="SELECT * FROM layer WHERE id='".$id."'"  ;
      $vysledek=mysql_query($query);
                                  	while($radek = MySQL_Fetch_Array($vysledek))
                        						{ 
                                    echo'  
                        							<tr><td><label for="scale">Měřítko</label></td><td><input id="scale" type="text" name="scale" value="'.$radek['scale'].'" class="text ui-widget-content ui-corner-all"></td></tr> 
                                      <tr><td><label for="rotx">Rotace X</label></td><td><input id="rotx" type="text" name="rotx" value="'.round(rad2deg($radek['rotx'])).'" class="text ui-widget-content ui-corner-all"></td></tr>
                                      <tr><td><label for="roty">Rotace Y</label></td><td><input id="roty" type="text" name="roty" value="'.round(rad2deg($radek['roty'])).'" class="text ui-widget-content ui-corner-all"></td></tr>
                                      <tr><td><label for="rotz">Rotace Z</label></td><td><input id="rotz" type="text" name="rotz" value="'.round(rad2deg($radek['rotz'])).'" class="text ui-widget-content ui-corner-all"></td></tr>
                                      <tr><td><label for="locx">Lokace X</label></td><td><input id="rotz" type="text" name="locx" value="'.$radek['locx'].'" class="text ui-widget-content ui-corner-all"></td></tr>
                                      <tr><td><label for="locy">Lokace Y</label></td><td><input id="rotz" type="text" name="locy" value="'.$radek['locy'].'" class="text ui-widget-content ui-corner-all"></td></tr>
                                      <tr><td><label for="locz">Lokace Z</label></td><td><input id="rotz" type="text" name="locz" value="'.$radek['locz'].'" class="text ui-widget-content ui-corner-all"></td></tr>
                                     '; 
                                      } ;
      
      
           
           
echo      '<tr><td><input type="submit" value="Nastavit Vrstvu"></td></tr>
      </table>    
    </form>'; };




echo '</body>
</html>';

$db->update_layer();

?>