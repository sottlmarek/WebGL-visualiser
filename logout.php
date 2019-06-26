<?php
//inc tříd
include('init.php');

//práce se session
$user->session();
$user->end_session();                                                                                                                                                                                                                             

//přesměrování na domovskou stránku
header("Location: index.php?action=logout");   
              
?>