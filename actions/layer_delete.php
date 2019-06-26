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

if($action<>'send'){ echo   '<form action="layer_delete.php?action=send&id='.$id.'" method="post">      
      <table>
      
      '  ;
      
      $query="SELECT * FROM layer WHERE id='".$id."'"  ;
      $vysledek=mysql_query($query);
                                  	while($radek = MySQL_Fetch_Array($vysledek))
                        						{ 
                                    echo'  
                        							<tr><td>Opravdu chcete vrstvu smazat?</td></tr>'; 
                                      } ;
      
      
           
           
echo      '<tr><td><input type="submit" value="Smazat vrstvu"></td></tr>
      </table>    
    </form>';  }




echo '</body>
</html>';

$db->delete_layer();
?>