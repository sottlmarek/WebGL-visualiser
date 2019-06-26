<?php
include("..\init.php");
echo '
<html>  
  <link rel="stylesheet" href="../design.css">  
  <head>    
    <title>import     
    </title>    
    <meta http-equiv="content-type" content="text/html; charset=utf-8">  
  </head>  
  <body>    
    <form action="upload.php?action=send&id='.$_GET["id"].'" method="post" enctype="multipart/form-data">      
      <input type="text" name="layer_name">      
      <input type="file" name="file">      
      <input type="image" src="../images/upload.png" class="transparent">    
    </form>';



$layer=new Layer()  ;
$layer->upload_layer();
echo '</body>
</html>';
?>