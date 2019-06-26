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
    <form action="upload_texture.php?action=send" method="post" enctype="multipart/form-data">
      <input type="file" name="file" size="10">
      <input type="image" src="../images/upload.png" class="transparent">  
    </form>';
   $layer=new Layer()  ;
   $layer->upload_texture();
echo '
</body>
</html> ';
?>