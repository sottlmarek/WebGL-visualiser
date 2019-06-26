<?php
Class Scene
{ 

public function global_setting(){
echo '//Global atributes';

$dotaz = "SELECT * FROM layer WHERE id_model='".$_GET["id_modelu"]."';";								
$vysledek=mysql_query($dotaz);
                                while($radek = MySQL_Fetch_Array($vysledek))
                        						{    
echo"\n";                        							$name = $radek['name'];
echo  'var '.$name.'_hide=true;';

                                    };
  
echo 'var mod=\'default\'; 
      var view=false;
      var rotation=0;
      var scale=1.0; 
      var scene = new GLGE.Document();
      var canvas = document.getElementById( \'canvas\' );
      

 // mode selection
 function set_mode(mode){
		mod=mode;		
	}';

}


public function hide_and_seek(){
echo '	
// hiding and unhiding
	
	 function over(id){
		if (document .getElementById (id).checked==true) {  ';
			
      $dotaz = "SELECT * FROM layer WHERE id_model='".$_GET["id_modelu"]."';";								
      $vysledek=mysql_query($dotaz);
                                while($radek = MySQL_Fetch_Array($vysledek))
                        						{    
                        							$name = $radek['name'];
                                echo  'if(id==\''.$name.'\')'.$name.'_hide=true;';
                                    };
      
 echo'     

			}
			
		else   {
	';
  
     $dotaz = "SELECT * FROM layer WHERE id_model='".$_GET["id_modelu"]."';";								
      $vysledek=mysql_query($dotaz);
                                while($radek = MySQL_Fetch_Array($vysledek))
                        						{    
                        							$name = $radek['name'];
                                echo  'if(id==\''.$name.'\')'.$name.'_hide=false;';
                                    };
  echo'
			}
	}  ';
}

public function createScene(){

echo'
scene.onLoad=function(){  

      canvas.onmousedown=function(e){
    	if(e.button==0){
            view=true;
            
    	}
    	e.preventDefault();
    }
  
  canvas.onmouseup=function(e){
  	view=false;
  } 


//create the renderer
var sceneRenderer=new GLGE.Renderer(document.getElementById(\'canvas\'));
projectScene=new GLGE.Scene();
projectScene=scene.getElement("mainscene");
sceneRenderer.setScene(projectScene); ';
}

public function addModels(){

  //////////////////////////////////////////////WEBGL///////////////////////////////////////////////////////////////////////////////////////////

echo'
// add collada model
';
$dotaz = "SELECT * FROM layer WHERE id_model='".$_GET["id_modelu"]."';";								
$vysledek=mysql_query($dotaz);
            while($radek = MySQL_Fetch_Array($vysledek))
                {    
                $name = $radek['name'];
                                      
               echo'
                var '.$name.'=new GLGE.Collada();
                '.$name.'.setDocument("./filebase/'.$name.$_GET["id_modelu"].'.dae");
                '.$name.'.setScale('.$radek['scale'].');
                '.$name.'.setRotX('.$radek['rotx'].');
                '.$name.'.setRotY('.$radek['roty'].');
                '.$name.'.setRotZ('.$radek['rotz'].');
                '.$name.'.setLocY('.$radek['locy'].');
                '.$name.'.setLocZ('.$radek['locz'].');
                '.$name.'.setLocX('.$radek['locx'].');
                projectScene.addCollada('.$name.');';
                };


}

public function checkScene(){
//controls 
echo '
var mouse=new GLGE.MouseInput(document.getElementById(\'canvas\'));
var keys=new GLGE.KeyInput();
var mouseovercanvas;
var hoverobj;

function check_visibility(){ ' ;
  
  $dotaz = "SELECT * FROM layer WHERE id_model='".$_GET["id_modelu"]."';";								
      $vysledek=mysql_query($dotaz);
                                while($radek = MySQL_Fetch_Array($vysledek))
                        						{    
                        							$name = $radek['name'];
                                      
                                echo'if('.$name.'_hide==false) {'.$name.'.setVisible(false);}else{'.$name.'.setVisible(true);}';
                                    };



echo'  }';
  
}


                                


public function controls(){
echo '
 //controling with keys
function checkkeys(){

	var camera=projectScene.camera;
	camerapos=camera.getPosition();
	camerarot=camera.getRotation();
	var mat=camera.getRotMatrix();

	var trans=GLGE.mulMat4Vec4(mat,[0,0,-1,1]);
	var mag=Math.pow(Math.pow(trans[0],2)+Math.pow(trans[1],2),0.5);
	trans[0]=trans[0]/mag;
	trans[1]=trans[1]/mag;
	var yinc=0;
	var xinc=0;

	if(keys.isKeyPressed(GLGE.KI_W) || keys.isKeyPressed(GLGE.KI_UP_ARROW)) {yinc=yinc+parseFloat(trans[1]);xinc=xinc+parseFloat(trans[0]);}
	if(keys.isKeyPressed(GLGE.KI_S) || keys.isKeyPressed(GLGE.KI_DOWN_ARROW)) {yinc=yinc-parseFloat(trans[1]);xinc=xinc-parseFloat(trans[0]);}
	if(keys.isKeyPressed(GLGE.KI_A) || keys.isKeyPressed(GLGE.KI_LEFT_ARROW)) {yinc=yinc+parseFloat(trans[0]);xinc=xinc-parseFloat(trans[1]);}
	if(keys.isKeyPressed(GLGE.KI_D) || keys.isKeyPressed(GLGE.KI_RIGHT_ARROW)) {yinc=yinc-parseFloat(trans[0]);xinc=xinc+parseFloat(trans[1]);}
  if(keys.isKeyPressed(GLGE.KI_R)) {mod=\'reset\';}
  if(keys.isKeyPressed(GLGE.KI_Q)|| keys.isKeyPressed(GLGE.KI_ADD)) {approximate();}
  if(keys.isKeyPressed(GLGE.KI_E)|| keys.isKeyPressed(GLGE.KI_SUBTRACT)) {delay();}
  if(keys.isKeyPressed(GLGE.KI_P)) {mod=\'walker\';}
  if(keys.isKeyPressed(GLGE.KI_M)) {mod=\'manipulate\';}
	
  
	if(levelmap.getHeightAt(camerapos.x+xinc,camerapos.y)>50) xinc=0;
	if(levelmap.getHeightAt(camerapos.x,camerapos.y+yinc)>50) yinc=0;
	if(levelmap.getHeightAt(camerapos.x+xinc,camerapos.y+yinc)>50){yinc=0;xinc=0;}
	if(xinc!=0 || yinc!=0){camera.setLocY(camerapos.y+yinc*0.05*(now-lasttime));camera.setLocX(camerapos.x+xinc*0.05*(now-lasttime));}
  }       

 ' ;

}


public function mode_control(){
//controling with mouse 
echo 'function mousecontrol(){

  
  
    
  
  
  if(mod==\'walker\' && mouseovercanvas){ observer();} ;
            	                   

          	   
  //manipulace s objekty          
if(mod==\'manipulate\' && mouseovercanvas && view) {    
                        
           manipulate();
            };           
// reset scény
if(mod==\'reset\') {                        
                     reset();                  
            }  ;           
            
 if(mod==\'animation\') { 
                        animate(\'right\');
                  
 } ;
 
  if(mod==\'default\') { 
  //scene is stopped 
  } ;
  
    if(mod==\'approximate\') { 
  approximate();
  } ;
  
  
    if(mod==\'delay\') { 
  delay();
  } ;
}  

//animace


function manipulate(){
             /*
                        rotationy+=(mousepos.y)-lrotationy;
                        rotationx+=(mousepos.x)-lrotationx;
                        
                        projectScene.setRotX(rotationx); 
                        projectScene.setRotY(rotationy); 
                        
                        lrotationx=mousepos.x;
                        lrotationy=mousepos.y;
                         */
                         var mousepos=mouse.getMousePosition();
                        	mousepos.x=mousepos.x-document.getElementById("container").offsetLeft;
                        	mousepos.y=mousepos.y-document.getElementById("container").offsetTop;          		
                      	  projectScene.setRotX((mousepos.y)*(-0.04));
                      	  projectScene.setRotY((mousepos.x)*(0.04)) ;
};


function reset(){
projectScene.setRotX(0);
projectScene.setRotY(0);
scale=1.0;
projectScene.setScale(scale);
  mod=\'default\'; 
}

function animate(direction){
 
        switch(direction) {
            case \'left\' : view=false ;     
                          rotation=rotation+0.01;           
                          projectScene.setRotZ(rotation); break;
            case \'right\' : view=false ;     
                          rotation=rotation-0.01;           
                          projectScene.setRotZ(rotation); break;
}}

function approximate(){scale+=0.1;}
function delay(){scale-=0.1;}



function observer(){
	//zdrojový kód z ukázky Collada k GLGE
  var mousepos=mouse.getMousePosition();
	mousepos.x=mousepos.x-document.getElementById("container").offsetLeft;
	mousepos.y=mousepos.y-document.getElementById("container").offsetTop;
	var camera=projectScene.camera;
	var trans=GLGE.mulMat4Vec4(camera.getRotMatrix(), [0, 0, -1, 1]);
	var mag=Math.pow(Math.pow(trans[0],2)+Math.pow(trans[1],2), 0.5);
	
	  		
                    		//view=false;
                    		camerarot=camera.getRotation();
                    		inc=(mousepos.y-(document.getElementById(\'canvas\').offsetHeight/2))/500;
                    		
                    		trans[0]=trans[0]/mag;
                    		trans[1]=trans[1]/mag;
                    		camera.setRotX(1.56-trans[1]*inc);
                    		camera.setRotZ(-trans[0]*inc);
                    		var width=document.getElementById(\'canvas\').offsetWidth;
                    		
                                      if(mousepos.x<width*0.3){
                                    		var turn=Math.pow((mousepos.x-width*0.3)/(width*0.3),2)*0.005*(now-lasttime);
                                    		camera.setRotY(camerarot.y+turn);
                            		        }
                            		
            		                        if(mousepos.x>width*0.7){
                                  			var turn=Math.pow((mousepos.x-width*0.7)/(width*0.3),2)*0.005*(now-lasttime);
                                  			camera.setRotY(camerarot.y-turn);
            		                        }

} ';
}

public function render_cycle()  {
echo'levelmap=new GLGE.HeightMap("images/map.png",120,120,-50,50,-50,50,0,50);


var lasttime=0;
var frameratebuffer=60;
start=parseInt(new Date().getTime());
var now;



//scene rendering cycle

function render(){
     now=parseInt(new Date().getTime());
//framerate z ukázky Collada GLGE zakomentován, byl použit pouze v prototypech
//	    frameratebuffer=Math.round(((frameratebuffer*9)+1000/(now-lasttime))/10);
//	    document.getElementById("debug").innerHTML="Frame Rate:"+frameratebuffer;
      projectScene.setScale(scale);
      mousecontrol();
      checkkeys();
      check_visibility();
      sceneRenderer.render();
      lasttime=now;
}

setInterval(render,0.5);
var inc=0.2;
document.getElementById("canvas").onmouseover=function(e){mouseovercanvas=true;}

} ;


  scene.load("scene.xml");';

}

}


?>