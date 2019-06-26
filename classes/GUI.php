<?php
Class GUI
{
public function header($name,$id=""){
      echo '
      <!DOCTYPE html>
      <html>                                            
        <head>                                                                                 
          <title>'.$name.'                                                                           
          </title>                                                                               
          <meta http-equiv="content-type" content="text/html; charset=utf-8">
          <meta name="author" content="Bc. Marek Šottl">
          <meta name="keywords" content="COLLADA, 3D vizualizace, Zoomorfní modely, modely, 3D, systém, Systém pro prostorovou vizualizaci">                                                           
          <script src="webGL/glge-compiled.js"></script>                    	                                                           
          <script src="jquery/jquery-1.7.1.js"></script>                	                                                     
          <script src="jquery/external/jquery.bgiframe-2.1.2.js"></script>                	                                                     
          <script src="jquery/ui/jquery.ui.core.js"></script>                                                                       
          <script src="jquery/ui/jquery.ui.widget.js"></script>                	                                                     
          <script src="jquery/ui/jquery.ui.mouse.js"></script>                	                                                     
          <script src="jquery/ui/jquery.ui.draggable.js"></script>                	                                                     
          <script src="jquery/ui/jquery.ui.position.js"></script>                	                                                     
          <script src="jquery/ui/jquery.ui.resizable.js"></script>
          <script src="jquery/ui/jquery.ui.autocomplete.js"></script>                	                                                     
          <script src="jquery/ui/jquery.ui.dialog.js"></script>                	                                                     
          <script src="jquery/ui/jquery.effects.core.js"></script>                                                                       
          <script src="jquery/ui/jquery.effects.drop.js"></script>                             
          <script src="jquery/ui/jquery.ibutton.js"></script>                                                                       
          <script src="jquery/jquery.tipTip.js"></script>                         
          <script src="jquery/ui/jquery.ui.tabs.js"></script>                         
          <script src="jquery/ui/jquery.ui.accordion.js"></script>
          <script src="jquery/jquery.lionbars.0.3.js"></script>
          <script src="jquery/dynamic_content.php?id_modelu='.$id.'"></script> 
          <link rel="stylesheet" href="jquery/tipTip.css"> 
          <link rel="stylesheet" href="jquery/form.css">        
          <link rel="stylesheet" href="jquery/lionbars.css">                                                                                 
          <link rel="stylesheet" href="jquery/themes/base/jquery.ui.all.css">
          <link rel="stylesheet" href="jquery/jQuery.css">                                                                         
          <link rel="stylesheet" href="design.css">	                    
          <link rel="shortcut icon" href="images/favicon.ico">
          
          	            	                                                                                                                
        </head>                                            
      ';
}
public function glScene(){
      echo'
        
<div id="container">                                                                                                                                                       
  <canvas id="canvas" width="750" height="450">                                                                                                             
  </canvas>          
  <div id="manipulator" > ';                                                                  
          
          $this->manipulation_button("walker","walk","Průzkumník");
          $this->manipulation_button("manipulate","hand","Manipulace");
          $this->manipulation_button("reset","reset","Reset");
          $this->manipulation_button("anim","anim","Animace");
          $this->manipulation_button("delay","delay","Oddálit");
          $this->manipulation_button("approximate","approximate","Přiblížit");
          $this->manipulation_button("help_open","help","Nápověda");
      echo      '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
          </div>                                                                                                                                                                                                             	                                                                                                                                                                             
        </div> ';
}

public function footer($class=""){ 
                     
          echo'    
<div id="footer" class="'.$class.'">           (c)System for spatial visualization Marek Šottl 2012             Powered on:              
  <a href="http://jquery.com/" target="_blank">
    <img src="images/jquery_logo.jpeg" class="pic" alt=""></a>            
  <a href="http://www.glge.org/" target="_blank">
    <img src="images/glge_logo.jpeg" class="pic" alt=""></a>            
  <a href=" http://www.mysql.com/" target="_blank">
    <img src="images/mysql_logo.jpeg" class="pic" alt=""></a>            
  <a href="http://html5.com/" target="_blank">
    <img src="images/html_css.png" class="pic" alt=""></a>            
  <a href="http://webgl.com/" target="_blank">
    <img src="images/webGL_logo.jpeg" class="pic" alt=""></a>            
</div>                                                                                                                                    
</body>          
</html> ';  
          
          }
public function filter(){
          echo'    
          <div id="filter"> ';
           if($_SESSION['type']>=2)   {
          echo '                 
              <img src="images/layer.png" class="button tooltip layer" title="Nová vrstva modelu">             
              <img src="images/addTexture.png" class="button tooltip texture" title="Přidat texturu"> '; }
          
          echo '              
              <img src="images/showall.png" class="button tooltip checkAll" title="Zobrazit všechny vrstvy">               
              <img src="images/hideall.png" class="button tooltip uncheckAll" title="Skrýt všechny vrstvy">                
              <br/>                    
              <hr>             
              ';
              $dotaz = "SELECT * FROM layer WHERE id_model='".$_GET["id"]."';";								
              $vysledek=mysql_query($dotaz);
              echo'<div id="filterlist" class="scroll"><table>';
                                while($radek = MySQL_Fetch_Array($vysledek))
                        						{    
                        							$name = $radek['name'];
                                      $id = $radek['id'];
                                      echo"\n";
    
                  echo  '                                     
                                  <tr>
                                  <td><input type="checkbox" id="'.$name.'" class="visibility" value="'.$name.'" checked="checked" /></td>                                      
                                  <td><label for="kostra">'.$name.'</label></td>                                     
                                  ';
                  if($_SESSION['type']>=2)   {
                          echo'                
                  <td>
                    <img id="'.$id.'" src="images/delete.png" class="delete tooltip" title="smazat vrstvu '.$name.'"></td>                        <td>
                    <img id="'.$id.'" src="images/edit.png" class="mini_butt tooltip" title="editovat vrstvu '.$name.'"></td>                        
                  </tr>                      
                                           ';   
                                   }
echo"\n";   
                                    };                                       
echo'              </table></div></div> ';
}


public function navigation($user) {
             
            echo '<body>                                                  
              
                    <div id="navigation"> ';                                                                            
                      $this->logo();
                      if($user<>'no_user')$this->registered_user();
                      
             echo    '<div id="menu">';                                                                                                          

                  if($user<>'no_user'){
                  if($_SESSION['type']>=3){
                  
                  $this->button("users.php","users","Správa uživatelů");  }
                  if($_SESSION['type']>=2){
                  $this->button("add_category.php","category","Přidat kategorii"); ;
                  $this->button("add_model.php","plus","Přidat model");}
                  $this->button("account.php","setting","Nastavení účtu");
                  $this->button("logout.php","door","Odhlásit se");
                  $this->general_button("back","back","Zpět");
                  $this->button("home.php","home","Domů"); } ;
                  
            echo'                                                                                                                                                                                     
                </div>                                                          
              </div> ';
              echo "\n"; 
}


public function help(){
                echo'  
                  <div id="help" title="Nápověda ke scéně">                                                                                                            
                    <div id="help_content">                                                                                                                        
                      <img src="images/wsad.jpeg" width="100" height="80">Základní pohyb ve scéně je řízen klávesami W,S,A,D. Scéna obsahuje několik manipulačních režimů.                                                                                                      
                    </div>                                                                   
                  </div> ';
                  echo "\n";
                        /* <img src="images/wsad.jpeg" width="100" height="80">Základní pohyb ve scéně je řízen klávesami W,S,A,D. Scéna obsahuje několik manipulačních režimů.  */
}



public function layer_window(){
                echo'  
                  
                      <div id="layer" title="Import nové vrstvy">                                                                                                                                                                                                                                                       
                        <iframe src="actions/upload.php?id='.$_GET["id"].'" width="320" height="110" scrolling="no">                      
                        </iframe>                                                                                                                                                                                                  
                      </div> ';
                  echo "\n";
                        /* <img src="images/wsad.jpeg" width="100" height="80">Základní pohyb ve scéně je řízen klávesami W,S,A,D. Scéna obsahuje několik manipulačních režimů.  */
}



public function texture_window(){
                echo'  
                  <div id="texture" title="Import nové textury">                                                                                               
                      <iframe src="actions/upload_texture.php" width="320" height="80" scrolling="no">
                      </iframe>                                                                                           
                                                                                   
                  </div> ';
                  echo "\n";
                        /* <img src="images/wsad.jpeg" width="100" height="80">Základní pohyb ve scéně je řízen klávesami W,S,A,D. Scéna obsahuje několik manipulačních režimů.  */
}


public function rightPanel($behavior=""){
                            $db=new Database("localhost","root","","visualization");
                            switch($behavior){
                            case 'index': echo '<div id="right_panel_nobg">'; 
                              $this->login();
                              $this->register();
                              echo '</div>';
                              echo "\n";
                              break;
                              
                            default:
                            echo'                                                                                                                                 
                              <div id="right_panel">                                                              
                                <div id="tabs">	                                                                  
                                  <ul>		                                                                                  
                                    <li>                                                                                 
                                    <a href="#tabs-1">Hledat </a>                                                                                 
                                    </li>		                                                                                  
                                    <li>                                                                                 
                                    <a href="#tabs-2">Oblíbené</a>                                                                                 
                                    </li>		                                                                                  
                                    <li>                                                                                 
                                    <a href="#tabs-3">Kategorie</a>                                                                                 
                                    </li>	                                                                  
                                  </ul>	                                                                  
                                  <div id="tabs-1">	';	                                                                                  
                                      $this->search_panel();	                                                        
                            echo   '</div>	                                                                  
                                  <div id="tabs-2">';	                                                                                  
                                    $this->favorite();	                                                                  
                                  echo '</div>	                                                                  
                                  <div id="tabs-3">';
                                  $this->filter_panel();                                                          
                           echo   '</div>                                                                
                                </div>                                                    
                              </div> '; 
                              echo "\n";
                              break;
                              echo "\n";
                              break;
                            }
}

public function logo(){
echo '<img class="logo" src="images/logo.png">'; 
}

public function registered_user(){
                            echo "<div id='user'>" ;                                                                         
                            echo $_SESSION["mail"] ;
                            echo "</div>" ; 
                        }

public function favorite()
{
                            $db=new Database("localhost","root","","visualization");
                            $dotaz = "SELECT * FROM `model` WHERE id <> '0' ORDER BY visits DESC LIMIT 0 , 30";								
                            $vysledek=$db->query($dotaz);
                                                            
                                                            	while($radek = MySQL_Fetch_Array($vysledek))
                                                  						{
                                                                echo "<div id='imagebox'>
  <a href='model.php?id=".$radek['id']."' class='box'>
    <img src='images/noimage.png' border=\"1\">
    </br>".$radek['name']."</a>
</div>
</br>\n";
                                                 						  } ;
}



public function infopanel($db){
echo '<div id="infopanel" class="description"><h3> 

           <a href="#">Název modelu</a></h3>                                                   
              <div>';
                                       $dotaz = "SELECT name FROM model where id='".$_GET["id"]."';";								
                                                                $vysledek=$db->query($dotaz);
                                                                echo "\n";
                                                                	while($radek = MySQL_Fetch_Array($vysledek))
                                                      						{
                                                                    echo "<b>".$radek['name']."</b></br>";
                                                     						    echo "\n"; };
echo "</div>";
                                                                                                                     
echo'       <h3><a href="#">Kategorie</a></h3>                                                   
    <div>';
                                       $dotaz = "SELECT id_model,id_tag,model.id,category_tag.id,category.id,id_category, model.name,category.name as categoryname,category_tag.value as tagvalue FROM model, category, category_tag, tag_model WHERE model.id = tag_model.id_model AND tag_model.id_tag = category_tag.id AND category.id = category_tag.id_category AND model.name <> '' AND model.id=".$_GET["id"]."  LIMIT 0 , 30";								
                                                                $vysledek=$db->query($dotaz);
                                                                echo "\n";
                                                                	while($radek = MySQL_Fetch_Array($vysledek))
                                                      						{
                                                                    echo "<b>".$radek['categoryname']."</b>: ".$radek['tagvalue']."</br>";
                                                     						    echo "\n";
                                                                   } ;                                 
echo '</div>                <h3>                                            
      <a href="#">Popis modelu</a></h3>                                                   
    <div> ';
    $dotaz = "SELECT * FROM description,model WHERE description.id=model.id_description AND model.id=".$_GET["id"];								
                                                                $vysledek=$db->query($dotaz);
                                                                
                                                                	while($radek = MySQL_Fetch_Array($vysledek))
                                                      						{
                                                                    echo "
                                                                  <form action=\"model.php?id=".$_GET["id"]."\" method=\"post\" name=\"myForm\" id='no_shadow'>\n
                                                                    <table>";
                                                                if($_SESSION['type']>=2)echo"<input type=\"submit\" value=\"uložit změny\" class=\"submit_form right_submit text ui-widget-content ui-corner-all\">&nbsp;\n";      
                                                                echo "<textarea rows=\"15\" cols=\"120\" border=0 class='bio text ui-widget-content ui-corner-all' name=\"content\"";
                                                                if($_SESSION['type']==1) echo " readonly=\"readonly\"";
                                                                echo ">\n".$radek['content'] ;
                                                             
                                                                       
                                                     						  } ;    
    
  echo'</textarea>
    
</table>    
</form>
</br>
</div>
</div>';
  echo "\n";
  }
  
public function general_button($mode,$image,$tooltip){
    echo'<img src="images/'.$image.'.png" class="'.$mode.' button tooltip" title="'.$tooltip.'" alt="">';
    echo "\n"; 

}

private function button($link,$image,$tooltip){
                          echo'        <a href="'.$link.'"><img src="images/'.$image.'.png" class="button tooltip" title="'.$tooltip.'" alt=""></a>';
                          echo "\n";
}

private function manipulation_button($mode,$image,$tooltip){
                          echo'<img src="images/'.$image.'.png" class="'.$mode.' mode tooltip" title="'.$tooltip.'" alt="">';
                          echo "\n"; 
                          }


public function login ()
{
                            echo '
                        Pokud se chcete přihlásit:
                        <form  action="index.php?action=validate" method="post" name="myForm">
                           <table class="tab_login">
                           &nbsp;Login
                               <tr>
                               <td>email:</td><td><input type="text" name="email" value="" class="text ui-widget-content ui-corner-all"></td>
                               </tr>
                               <tr>
                               <td>heslo:</td><td><input type="password" name="passwd" value="" class="text ui-widget-content ui-corner-all"></td></tr>
                               <tr>
                                </table>
                              
                               <input type="submit" value="přihlásit" class="submit_form">&nbsp;
                               <input type="reset" value="reset" class="submit_form">
                               
                              
                          
                         </form>
                        <br />
                        <br />
                        <br />
                         ' ;
                         echo "\n";               
                              }
                              
public function register ()
{
                            echo '
                        Pokud se chcete zaregistrovat:
                        <form action="index.php?action=reg" method="post" name="myForm" >
                           <table class="tab_login" width="100">
                               &nbsp;Registrace
                               <tr>
                               <td>email:</td><td><input type="text" name="email" value="" class="text ui-widget-content ui-corner-all" ></td>
                               </tr>
                               <tr>
                               <td>heslo:</td><td><input type="password" name="password" value="" class="text ui-widget-content ui-corner-all"></td></tr>
                               <tr>
                                
                                 <tr>
                                 <td>jsem:
                                 </td>
                                 <td>
                                 <select name="type">
                                 <option value="1">student</option>
                                 <option value="2">tutor</option>
                                 </select>
                                 </td>
                               </tr>
                                </table>
                               <input type="submit" value="registrovat" class="submit_form">&nbsp;
                               <input type="reset" value="reset" class="submit_form"> 
                               <br />
                          
                         </form> <br />
                         ' ;              
                              }
                              
public function welcomeScreen(){
echo'<div id="welcome"> 
   </div>';
//echo'    <video id="welcome" loop autoplay="autoplay">  
//         <source src="intro.mp4" type="video/mp4" />
//    </video>    ';
}

public function genFormCategory(){

$db=new Database("localhost","root","","visualization");
echo '<div><form action="add_model.php?action=send" method="post" name="muj_formular"  class="left_form">
                           <table>
                               <b>Vložení modelu</b>';
                                echo '<tr>
                                        <td>Jmeno</td><td><input type="text" name="name" value="" class="text ui-widget-content ui-corner-all"></td>
                                      </tr> ';
                                    
                                $dotaz = "SELECT * FROM category;";								
                                $vysledek=$db->query($dotaz);
                                
                                	while($radek = MySQL_Fetch_Array($vysledek))
                      						{    
                      							//naplnní pole pro select value=>popisek v selectu
                      							$name = $radek['name'];
                      							 echo'
                                     <tr>
                                        <td>'.$name.'</td><td><input type="text" name="'.$radek['id'].'" value="" class="text ui-widget-content ui-corner-all"></td>
                                      </tr> 
                                     ';
                      						}
                                
                               
                               
                            
                              
                              echo '</table><input type="submit" value="Přidat model" class="submit_form">&nbsp;
                               <input type="reset" value="Vymazat všechna pole" class="submit_form">
                               
                               <br />
                          
                         </form></div>';
}


public function formADDcat(){
echo '<div><form action="add_category.php?action=send" method="post" name="myForm"  class="left_form">
                           <table>
                               <b>Vložení kategorie</b>';
                                echo '<tr>
                                        <td>Jméno</td><td><input type="text" name="name" value="" class="text ui-widget-content ui-corner-all"></td>
                                      </tr> ';
                                 echo '<tr>
                                        <td>Popisek</td><td><input type="text" name="description" value="" class="text ui-widget-content ui-corner-all"></td>
                                      </tr> ';   
                               
                               
                               
                            
                              
                              echo '</table><input type="submit" value="Přidat kategorii" class="submit_form">&nbsp;
                               <input type="reset" value="Vymazat všechna pole" class="submit_form">
                               
                               <br />
                          
                         </form></div>';
}


public function formUserEdit($id){
                        $db=new Database("localhost","root","","visualization");
                        echo '<div><form action="account.php?action=send" method="post" name="myForm"  class="left_form">
                                                   <table>
                                                       <b>Editace mého účtu</b>';
                                                        
                                                       $dotaz = "SELECT * FROM `user`,`contact` WHERE user.id = '".$id."' AND user.id_contact=contact.id";								
                                                       $vysledek=$db->query($dotaz);
                                                                                        
                                                       while($radek = MySQL_Fetch_Array($vysledek))
                                                       {
                                                     
                                                        echo '<tr>
                                                                <td>Email</td><td><input type="text" name="email" value="'.$radek['email'].'" class="text ui-widget-content ui-corner-all"></td>
                                                              </tr> ';
                                                         echo '<tr>
                                                                <td>Jméno</td><td><input type="text" name="name" value="'.$radek['name'].'" class="text ui-widget-content ui-corner-all"></td>
                                                              </tr> ';
                                                        echo '<tr>
                                                                <td>Příjmení</td><td><input type="text" name="lastname" value="'.$radek['lastname'].'" class="text ui-widget-content ui-corner-all"></td>
                                                              </tr> ';
                                                        echo '<tr>
                                                                <td>Heslo</td><td><input type="password" name="pass1" value="" class="text ui-widget-content ui-corner-all"></td>
                                                              </tr> ';
                                                              
                                                        echo '<tr>
                                                                <td>Zopakujte heslo</td><td><input type="password" name="pass2" value="" class="text ui-widget-content ui-corner-all"></td>
                                                              </tr> ';
                                                               } ;  
                                                      echo '</table><input type="submit" value="Upravit účet" class="submit_form">&nbsp;
                                                       
                                                       <br />
                                                  
                                                 </form></div>';

}


public function search_panel(){
                              $db=new Database("localhost","root","","visualization");
                              $search=isset($_POST["search"]) ? $_POST["search"] : null;
                              $id=isset($_GET["id"]) ? $_GET["id"] : null;;
                              
                              echo '<div><form action="?id='.$id.'&search='.$search.'" method="post" name="myForm"><table> <tr><td>                               
                                                                        <input type="text" name="search" value="" id="tags" class="text ui-widget-content ui-corner-all"> </td><td>
                                                                        <input type="image" SRC="images/search.png" id="submit_button">                           
                                   </td></tr></table> </form></div></br>';
                              if($search<>null)$db->search($search);
}



public function filter_panel(){
                              $db=new Database("localhost","root","","visualization");
                              $filter=isset($_POST["category"]) ? $_POST["category"] : null;
                              $id=isset($_GET["id"]) ? $_GET["id"] : null;
                              if($id<>null) {
                              echo '<div><form action="?id='.$id.'&category='.$filter.'&#tabs-3" method="post" name="myForm"><table> <tr><td>                               
                                                                       
                                                                      <select name="category" > ';
                                                                      $dotaz = "SELECT id_model,id_tag,model.id,category_tag.id,category.id as id_category,id_category, model.name,category.name as categoryname,category_tag.value FROM model, category, category_tag, tag_model WHERE model.id = tag_model.id_model AND tag_model.id_tag = category_tag.id AND category.id = category_tag.id_category AND model.name <> '' AND model.id=".$_GET["id"]."  LIMIT 0 , 30";	
                                                                      $vysledek=$db->query($dotaz);
                                                                                        
                                                                      while($radek = MySQL_Fetch_Array($vysledek))
                                                                      { 
                                                                      echo' 
                                                                       <option value="'.$radek["id_category"].'">'.$radek["categoryname"].'</option>';    
                                                                      } ;
                                                                      echo'
                                                                        </select>
                                                                        </td><td>
                                                                        <input type="image" SRC="images/search.png" id="submit_button">                           
                              </td></tr></table> </form></div></br>';
                              
                                
                                
                                if($filter<>null) {
                                $dotaz = "SELECT category_tag.value as tag FROM model, category, category_tag, tag_model WHERE model.id = tag_model.id_model AND tag_model.id_tag = category_tag.id AND category.id = category_tag.id_category AND category.id=".$filter." AND model.id=".$id;								
                                $vysledek=$db->query($dotaz);
                                                                  
                                                                  	while($radek = MySQL_Fetch_Array($vysledek))
                                                        						{
                                                                      $tag = $radek['tag'];
                                                       						  } ; 
                                                                    
                                
                                $dotaz = "SELECT DISTINCT model.name as jmeno,model.id as ide FROM model, category_tag, tag_model WHERE model.id = tag_model.id_model AND tag_model.id_tag = category_tag.id AND category_tag.value='".$tag."';";								
                                $vysledek=$db->query($dotaz);
                                                                  
                                                                  	while($radek = MySQL_Fetch_Array($vysledek))
                                                        						{
                                                                      echo "<div id='imagebox'><a href='model.php?id=".$radek['ide']."' class='box'><img src='images/noimage.png' border=\"1\"></br>".$radek['jmeno']."</a></div></br>";
                                                       						  } ;     }
                              }
                                  else {echo '<p>Vyhledávat v kategoriích lze až po zobrazení výchozího 3D modelu.</p>';}
}


private function icon($name){
                              echo '<img src="/images/'.$name.'"> ';
}




public function counter($db){
                              echo "<div id='counter'>\n"  ;
                              
                              echo 'Počet zobrazení:';
                              echo $db->return_visits($_GET["id"]);
                              echo "</div>\n";
}

public function tweet(){
echo'<div id="tweet"><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script></script></div>';

}

public function like() {
echo '
<div id="fb-root"></div>
<div id="fb-like" class="fb-like" data-href="http://www.chromeexperiments.com/webgl" data-send="true" data-layout="button_count" data-width="400" data-show-faces="false" data-action="recommend"></div>';
}


public function who_inserted_this() {
$query="SELECT id_user,user.id,model.id,contact.id,id_contact,email, COUNT(email) as num FROM model, user, contact WHERE user.id=model.id_user AND user.id_contact=contact.id AND model.id=".$_GET["id"];
$vysledek=mysql_query($query);
                                                                    
                                                                  	while($radek = MySQL_Fetch_Array($vysledek))
                                                        						{
                                                                      if($radek['num']<>0){echo "<div id='who'>Vloženo uživatelem: ".$radek['email']."</div>"  ;}
                                                                      else{echo '<div id=\'who\'>Uživatel neznámý</div>';}    
                                                       						  } ; 
                                  }

public function print_users(){
                          $page=isset($_GET["page"]) ? $_GET["page"] : 1;
                          $count=30;
                          if($page==1){$page_min =  0; }else{$page_min =($page*$count)-$count;};
                          $page_max =  ($page * $count);
                          if($page<>1){$prev=  $page - 1;} else {$prev=0;}
                          $next=  $page + 1;
                          $query="SELECT *,user.id as userID FROM user, contact WHERE user.id_contact=contact.id LIMIT ".$page_min.",".$page_max.";";
                          $vysledek=mysql_query($query);
                                                                                            	
                          $query2="SELECT COUNT(*) as number FROM user, contact WHERE user.id_contact=contact.id ;";
                          $vysledek2=mysql_query($query2);
                          while($radek = MySQL_Fetch_Array($vysledek2))
              						{
                          $count_results=$radek['number'];                                                             
             						  } ; 


                          echo "
                          </br>
                          </br>
                          </br>
                          </br>
                          ";
                          
                          
                          if($prev>0)echo"<a href=?page=".$prev.">Předchozí</a>"  ;
                          if ($page*$count < $count_results) echo" <a href=?page=".$next.">Další</a>"; 
                          echo "
                          \n
                          <table class=\"summary\">";
                          echo "<tr class='header'><td>Email uživatele</td><td>Jméno</td><td>Příjmení</td><td>Typ uživatele</td><td colspan=\"3\">Akce</td></tr>"   ;
                                                                                            	while($radek = MySQL_Fetch_Array($vysledek))
                                                                                  						{                                                               
                                                                                              if($radek['name']==""){$name="nespecifikováno";}else{$name=$radek['name'];};
                                                                                              if($radek['lastname']==""){$lastname="nespecifikováno";}else{$lastname=$radek['lastname'];};
                                                                                              switch($radek['type']){
                                                                                              case 1:  $radek['type']="Student";break;
                                                                                              case 2:  $radek['type']="Tutor";break;
                                                                                              case 3:  $radek['type']="Správce";break;
                                                                                              
                                                                                              }
                                                                                              echo "<tr class='row'><td>".$radek['email']."</td><td>".$name."</td><td>".$lastname."</td><td> ".$radek['type']."</td><td>
                            
                                    
                            <td>
                            <form method=\"post\" action=\"?action=send\" class=\"small\">
                            <select name=\"type\">          
                              <option value=\"1\">Student
                              </option>          
                              <option value=\"2\" >Tutor
                              </option>          
                              <option value=\"3\" >Správce
                              </option>          
                            </select>
                            </td>
                            <td>
                            <input name=\"id\" type=\"hidden\" value=\"".$radek['userID']."\">
                            <input type=\"submit\" value=\"Změnit\">
                            </td>
                          </form></td>
                          </tr>"; 
                                                                                                                           						  } ; 
                                                                    
                                                                                                                                         echo"</table>";
          }

}



?>