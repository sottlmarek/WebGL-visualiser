     //Global atributes
  var kostra_hide=true;
  var skin_hide=true;
  var mod='default'; 
  var view=false;
  var rotation=0;
  var scale=1.0; 
  var scene = new GLGE.Document();
  var canvas = document.getElementById( 'canvas' );
  

 // mode selection
 function set_mode(mode){
		mod=mode;		
	}
	
// hiding and unhiding
	
	 function over(id){
		if (document .getElementById (id).checked==true) {
			if(id=='kostra')kostra_hide=true;
			if(id=='skin')skin_hide=true;	
			}
			
		else   {
			if(id=='kostra')kostra_hide=false;
			if(id=='skin')skin_hide=false;
			}
	}
  
  
  //////////////////////////////////////////////WEBGL///////////////////////////////////////////////////////////////////////////////////////////









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
var sceneRenderer=new GLGE.Renderer(document.getElementById('canvas'));
projectScene=new GLGE.Scene();
projectScene=scene.getElement("mainscene");
sceneRenderer.setScene(projectScene);


// add collada model
var skin=new GLGE.Collada();
skin.setDocument("./models/cow.dae");
skin.setScale(9.0);
skin.setRotX(1.57);
skin.setLocY(-21.0);
skin.setLocZ(-1.0);
skin.setLocX(2.0);
projectScene.addCollada(skin);


var kostra=new GLGE.Collada();
kostra.setDocument("./models/fff.dae");
kostra.setScale(0.4);
kostra.setLocZ(5.0);
kostra.setLocX(-4.0);
kostra.setLocY(0.0);
projectScene.addCollada(kostra);


 /*
var kostra=new GLGE.Collada();
kostra.setDocument("./models/fff.dae");
kostra.setScale(0.4);
projectScene.addCollada(kostra);*/

//controls 

var mouse=new GLGE.MouseInput(document.getElementById('canvas'));
var keys=new GLGE.KeyInput();
var mouseovercanvas;
var hoverobj;

function check_visibility(){
  if(kostra_hide==false) {kostra.setVisible(false);}else{kostra.setVisible(true);}
  if(skin_hide==false)   {skin.setVisible(false);}else{skin.setVisible(true);} 
  }
  
//controling with mouse 
function mousecontrol(){

  
  
    
  
  
  if(mod=='walker' && mouseovercanvas){ observer();} ;
            	                   

          	   
  //manipulace s objekty          
if(mod=='manipulate' && mouseovercanvas && view) {    
                        
           manipulate();
            };
            
// reset scény
if(mod=='reset') {                        
                     reset();                  
            }  ;           
            
 if(mod=='animation') { 
                        animate('right');
                  
 } ;
 
  if(mod=='default') { 
  //scene is stopped 
  } ;
  
    if(mod=='approximate') { 
  approximate();
  } ;
  
  
    if(mod=='delay') { 
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
  mod='default'; 
}

function animate(direction){
 
        switch(direction) {
            case 'left' : view=false ;     
                          rotation=rotation+0.01;           
                          projectScene.setRotZ(rotation); break;
            case 'right' : view=false ;     
                          rotation=rotation-0.01;           
                          projectScene.setRotZ(rotation); break;
}}

function approximate(){scale+=0.1;}
function delay(){scale-=0.1;}



function observer(){
	var mousepos=mouse.getMousePosition();
	mousepos.x=mousepos.x-document.getElementById("container").offsetLeft;
	mousepos.y=mousepos.y-document.getElementById("container").offsetTop;
	var camera=projectScene.camera;
	var trans=GLGE.mulMat4Vec4(camera.getRotMatrix(), [0, 0, -1, 1]);
	var mag=Math.pow(Math.pow(trans[0],2)+Math.pow(trans[1],2), 0.5);
	
	  		
                    		//view=false;
                    		camerarot=camera.getRotation();
                    		inc=(mousepos.y-(document.getElementById('canvas').offsetHeight/2))/500;
                    		
                    		trans[0]=trans[0]/mag;
                    		trans[1]=trans[1]/mag;
                    		camera.setRotX(1.56-trans[1]*inc);
                    		camera.setRotZ(-trans[0]*inc);
                    		var width=document.getElementById('canvas').offsetWidth;
                    		
                                      if(mousepos.x<width*0.3){
                                    		var turn=Math.pow((mousepos.x-width*0.3)/(width*0.3),2)*0.005*(now-lasttime);
                                    		camera.setRotY(camerarot.y+turn);
                            		        }
                            		
            		                        if(mousepos.x>width*0.7){
                                  			var turn=Math.pow((mousepos.x-width*0.7)/(width*0.3),2)*0.005*(now-lasttime);
                                  			camera.setRotY(camerarot.y-turn);
            		                        }

}

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
  if(keys.isKeyPressed(GLGE.KI_R)) {mod='reset';}
  if(keys.isKeyPressed(GLGE.KI_Q)|| keys.isKeyPressed(GLGE.KI_ADD)) {approximate();}
  if(keys.isKeyPressed(GLGE.KI_E)|| keys.isKeyPressed(GLGE.KI_SUBTRACT)) {delay();}
  if(keys.isKeyPressed(GLGE.KI_P)) {mod='walker';}
  if(keys.isKeyPressed(GLGE.KI_M)) {mod='manipulate';}
	
  
	if(levelmap.getHeightAt(camerapos.x+xinc,camerapos.y)>50) xinc=0;
	if(levelmap.getHeightAt(camerapos.x,camerapos.y+yinc)>50) yinc=0;
	if(levelmap.getHeightAt(camerapos.x+xinc,camerapos.y+yinc)>50){yinc=0;xinc=0;}
	if(xinc!=0 || yinc!=0){camera.setLocY(camerapos.y+yinc*0.05*(now-lasttime));camera.setLocX(camerapos.x+xinc*0.05*(now-lasttime));}
  }       

levelmap=new GLGE.HeightMap("images/map.png",120,120,-50,50,-50,50,0,50);


var lasttime=0;
var frameratebuffer=60;
start=parseInt(new Date().getTime());
var now;



//scene rendering cycle

function render(){
     now=parseInt(new Date().getTime());

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

}


scene.load("scene.xml");