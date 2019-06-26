<?php
Class JQuery
{ 


public function generate_Jquery(){
echo '
// JavaScript Document

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/cs_CZ/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));


!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");



$(document).ready( function() {  

 
// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 1000;

  
  //dialogy
   		$( ".delete" ).click(function() {
    var id=$(this).attr("id");
			
      $(\'<div  class="edit" title="Odstranění vrstvy"><iframe src="actions/layer_delete.php?id=\'+id+\'" width="260" height=\"100\" scrolling=\"no\"></iframe></div>\').dialog(
      {
      show: \'drop\',
      hide: \'drop\',
      minWidth: 260,
      maxHeight: 100,
      close: function(event,ui){   window.location.reload();  },
      resizable: false,
      modal: true }
      );
      
			return false;
      
		});
    
  

   
		$( ".mini_butt" ).click(function() {
    var id=$(this).attr("id");
			
      $(\'<div  class="edit" title="Nastavení vrstvy"><iframe src="actions/layer_setting.php?id=\'+id+\'" width="360" height=\"300\" scrolling=\"no\"></iframe></div>\').dialog(
      {
      show: \'drop\',
			hide: \'drop\',
      minWidth: 400,
      maxHeight: 204,
      modal: true,
      close: function(event,ui){   window.location.reload();  },
      resizable: false }
      );
			return false;
      
		});

  
  
  
  $(function() {
		$( "#layer" ).dialog({
			autoOpen: false,
			show: \'drop\',
			hide: \'drop\',
      minWidth: 350,
      maxHeight: 104,
      resizable: false,
      close: function(event,ui){   window.location.reload();  },
      modal: true
		});

		$( ".layer" ).click(function() {
			$( "#layer" ).dialog( "open" );
			return false;
      
		});
	});
  
    $(function() {
		$( "#texture" ).dialog({
			autoOpen: false,
			show: \'drop\',
			hide: \'drop\',
      minWidth: 350,
      maxHeight: 104,
      resizable: false,
      modal: true
		});

		$( ".texture" ).click(function() {
			$( "#texture" ).dialog( "open" );
			return false;
      
		});
	});
  
  
   //nápověda
  $(function() {
		$( "#help" ).dialog({
			autoOpen: false,
			show: \'drop\',
			hide: \'drop\',
      minWidth: 430,
      minHeight: 534,
      resizable: false,
      modal: true
      
		});

		$( ".help_open" ).click(function() {
			$( "#help" ).dialog( "open" );
			return true;
		});
	});
  
  
//oveření
$( ".visibility" ).click(function() {
over($(this).attr("value"));
});
	
  //zpět v historii
  	$( ".back" ).click(function() {
			self.history.back();
		});  
    
    //konektivita na WebGL
	$( ".manipulate" ).click(function() {
			set_mode(\'manipulate\');
		});
			$( ".walker" ).click(function() {
			set_mode(\'walker\');
		});
			$( ".anim" ).click(function() {
			set_mode(\'animation\');
		});
			$( ".reset" ).click(function() {
			set_mode(\'reset\');
		});
    $( ".delay" ).click(function() {
			if(scale>0.1)scale-=0.1;

		});
    $( ".approximate" ).click(function() {
			scale+=0.1;

		});

  
  
    //Tooltipy
  $(function(){
$(".tooltip").tipTip();
});

    //Menu Tooltipy
$(function(){
$(".mode").tipTip({defaultPosition: "right"});
});

  //Taby

	$(function() {
		$( "#tabs" ).tabs();
	});
  
 //manipulator 
  $(function() {
  $("#manipulator").draggable({ containment: "parent" ,});
  $("#manipulator").resizable();
  
  });
  
  
  //accordeon
  $(function() {
		var icons = {
			header: "ui-icon-circle-arrow-e",
			headerSelected: "ui-icon-circle-arrow-s"
		};
		$( ".description" ).accordion({
			icons: icons ,
      autoHeight: false
		});
	});
  
  
  
  //select all
$(".checkAll").click(function(){

$(\'input[type=checkbox]\').each(function(){
$(this).attr(\'checked\',true);
over($(this).attr("value"));
});

});

//deselectall
$(".uncheckAll").click(function(){

$(\'input[type=checkbox]\').each(function(){
$(this).attr(\'checked\',false); 
over($(this).attr("value"));
});

});

';
echo ' 
//autocomplete                                   
	$(function() {
		var availableTags = [';
                                $dotaz = "SELECT name FROM model;";								
                                
                                $vysledek=mysql_query($dotaz);
                                  	while($radek = MySQL_Fetch_Array($vysledek))
                        						{    
                        							echo "\"".$radek['name']."\",";
                       						   } ;
      
	echo'	];
		$( "#tags" ).autocomplete({
			source: availableTags
		});
	});';

echo'
 //scrollbar
  
$(\'#filterlist,#tabs-2,#tabs-1,#tabs-3\,.ui-autocomplete\').each(function(){ $(this).lionbars(); }); ';

}

}

?>