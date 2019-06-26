<?php
Class Database
{ 
function __construct($server,$user,$password,$database){
                                  MySQL_Connect($server, $user, $password) or die("Nepodařilo se připojit k databázi");
                                  MySQL_Select_DB($database) or die("Nepodařilo se otevřít databázi");
                                  $this->query("SET NAMES 'utf8'");
}


public function error($text){
                                  echo '<script>$(\'<div  class="alert"><img src="images/alert.png">&nbsp;'.$text.'</div>\').dialog(
                                  {resizable: false,show: \'drop\', hide: \'drop\', buttons: {Ok: function() {$( this ).dialog( "close" );}}});</script>';
}

public function ok($text){
                                  echo '<script>$(\'<div  class="alert"><img src="images/ok.png">&nbsp;'.$text.'</div>\').dialog(
                                  {resizable: false,show: \'drop\', hide: \'drop\', buttons: {Ok: function() {$( this ).dialog( "close" );}}});</script>';
                            }
/* 
public function connect($user,$server,$password,$database)
      {
                                  MySQL_Connect($server, $user, $password) or die("Nepodařilo se připojit k databázi");
                                  MySQL_Select_DB($database) or die("Nepodařilo se otevřít databázi");
                                  $this->query("SET NAMES 'utf8'");
      }
*/

public function query($dotaz)
     {
                                  $result = mysql_query($dotaz) or die ("Došlo k následující chybě dotazu: ". mysql_error());
                                  return $result;
     }
     
public function add_category()
{
                                  
                                  $name=isset($_POST["name"]) ? $_POST["name"] : null;
                                  $action=isset($_GET["action"]) ? $_GET["action"] : null;
                                  $description=isset($_POST["description"]) ? $_POST["description"] : null;
                                  
                                  if($description=="" or $description==null)$description="bez popisku";
                                  if(($name<>"") and ($action=="send")){
                                  $dotaz = "INSERT INTO category (name,description) VALUES ('".$name."','".$description."');";
                                  $this->query($dotaz);
                                  $this->ok("Kategorie přidána.");
                                  } ;
                                  
                                  if(($name=="") and ($action=="send")){$this->error("Nevyplnili jste jméno kategorie.");}
                                  

}

public function add_model($description=""){
                                  $user=$_SESSION["id"];
                                  $dotaz = "INSERT INTO model (name,id_user) VALUES ('".$_POST["name"]."','".$user."');";
                                  $this->query($dotaz);
                                  
                                  $dotaz = "INSERT INTO description (content) VALUES ('Nebyla vložena žádná doprovodná data')";								
                                  $this->query($dotaz);
                                  
                                  $dotaz = "UPDATE model SET id_description=".mysql_insert_id()." WHERE name='".$_POST["name"]."'";								
                                  $this->query($dotaz);                                                                    							
}

public function add_tag($category,$value){
                                  $dotaz = "INSERT INTO category_tag (id_category,value) VALUES ('".$category."','".$value."');";								
                                  $this->query($dotaz);}





public function add_visit($id){
                                $dotaz = "UPDATE model SET visits=visits+1 WHERE id=".$id." ";								
                                $this->query($dotaz);

}

public function update_description(){

                                $content=isset($_POST["content"]) ? $_POST["content"] : null;

                                if($content<>null){
                                $dotaz = "SELECT id_description FROM model WHERE id='".$_GET["id"]."';";								
                                
                                $vysledek=$this->query($dotaz);
                                  	while($radek = MySQL_Fetch_Array($vysledek))
                        						{    
                        							$id_description = $radek['id_description'];
                       						   } ;
                                     
                                
                                
                                $dotaz = "UPDATE description SET content='".$_POST["content"]."' WHERE id=".$id_description.";";									
                                $this->query($dotaz); 
                                //aktualizace celé stránky, aby byly viditelné změny
                                header("location: model.php?id=".$_GET["id"].""); }
}



public function update_user($id){
                                //nastavení post proměných
                                $name=isset($_POST["name"]) ? $_POST["name"] : null;
                                $lastname=isset($_POST["lastname"]) ? $_POST["lastname"] : null;
                                $email=isset($_POST["email"]) ? $_POST["email"] : null;
                                $pass1=isset($_POST["pass1"]) ? $_POST["pass1"] : null;
                                $pass2=isset($_POST["pass2"]) ? $_POST["pass2"] : null;
                                $action=isset($_GET["action"]) ? $_GET["action"] : null;
                                //hash hesla
                                $hash = hash('sha256', $pass1);
                                //výběr id kontaktu
                                $dotaz = "SELECT id_contact FROM user WHERE id='".$id."';";								
                                
                                $vysledek=$this->query($dotaz);
                                  	while($radek = MySQL_Fetch_Array($vysledek))
                        						{    
                        							$id_contact = $radek['id_contact'];
                       						   } ;
                                     

                                
                                //update kontaktů
                                if($name<>null and $lastname<>null and $email<>null and ($pass2==$pass1)){
                                $dotaz = "UPDATE contact SET email='".$email."',name='".$name."',lastname='".$lastname."' WHERE id='".$id_contact."';";									
                                $this->query($dotaz);  
                                $this->ok("Váš účet byl upraven.");
                                
                                //update hesla
                                if($pass1<>null and $pass2<>null)
                                $dotaz = "UPDATE user SET password='".$hash."' WHERE id=".$id.";";									
                                $this->query($dotaz);}else{
                               }
                               
                               //kontrola formuláře
                               if(($name==null or $lastname==null or $email==null or $pass1<>$pass2) and $action=="send"){
                                                      $error_message=" Chyba : ";
                                                      if($name==null)$error_message=$error_message."vyplňte jméno, ";
                                                      if($email==null)$error_message=$error_message."vyplnňte email, ";
                                                      if($lastname==null)$error_message=$error_message."vyplňte příjmení, "; 
                                                      if($pass1<>$pass2)$error_message=$error_message."hesla se neshodují. ";
                                                      
                                                      $this->error($error_message); 
                               } ;
}


public function update_type(){
$type=isset($_POST["type"]) ? $_POST["type"] : null;
$id=isset($_POST["id"]) ? $_POST["id"] : null;
$action=isset($_GET["action"]) ? $_GET["action"] : null;
$page=isset($_GET["page"]) ? $_GET["page"] : 1;


if($action=="send"){
$dotaz="UPDATE user SET type=". $type." WHERE id=".$id.";";
mysql_query($dotaz);

header("Location:?page=$page")   ;
                                        
}



}

public function fill_tags_models_category(){
                                  
                                  
                                  $name=isset($_POST["name"]) ? $_POST["name"] : null;
                                  $action=isset($_GET["action"]) ? $_GET["action"] : null;
                                  if(($name<>"") and ($_GET["action"]=="send")){
                                  
                                  $this->add_model();
                                  $dotaz = "SELECT * FROM category;";								
                                  $vysledek=$this->query($dotaz);
                                  	while($radek = MySQL_Fetch_Array($vysledek))
                        						{    
                        							$id = $radek['id'];
                                      
                        							if($_POST["$id"]==""){$this->add_tag($id,'nespecifikováno');}
                                      else {$this->add_tag($id,$_POST["$id"]); }
                                      $this->fill_tag_model($_POST["name"],mysql_insert_id()); 
                                      
                       						   } ;
                                     $this->ok("Operace proběhla úspěšně"); } ;
                                    if(($name=="") and ($action=="send")){$this->error("Vyplňte jméno modelu.");};
                                      
}                                   



public function fill_tag_model($name,$id_tag){
                                 $dotaz = "SELECT id FROM model WHERE name='".$name."'";								
                                                                  $vysledek=$this->query($dotaz);
                                                                  
                                                                  	while($radek = MySQL_Fetch_Array($vysledek))
                                                        						{    
                                                        							$id = $radek['id'];
                                                       						  }
                                
                                $dotaz2 = "INSERT INTO tag_model (id_model,id_tag) VALUES ('".$id."','".$id_tag."');";
                                $this->query($dotaz2);
}



public function register(){

                                  $hash = hash('sha256', $_POST["password"]);
                                  if(($_POST["email"]<>"") and ($_POST["password"]<>"") and ($_POST["type"]<>"")){
                                  $mail=$_POST["email"];
                                  if($this->check_mail($mail)){
                                  
                                  $dotaz = "INSERT INTO contact (email) VALUES ('".$_POST["email"]."');";								
                                  $vysledek=$this->query($dotaz);
                                  
                                  $dotaz = "INSERT INTO user (password,type,id_contact) VALUES ('".$hash."','".$_POST["type"]."','".mysql_insert_id()."');";								
                                  $vysledek=$this->query($dotaz); 
                                    
                                  $this->ok("Registrace byla úspešná");}else{$this->error("Špatný formát emailu");}
                                  }else{$this->error("Vypňte všechny položky");}  }

 /* převzato z http://www.linuxjournal.com/article/9585*/
 public function check_mail($email){
                                 if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                                 {
                                 return false;
                                 }else  {return true;}
}



public function print_categories()
{
                                  $dotaz = "SELECT * FROM model, category, category_tag, tag_model WHERE model.id = tag_model.id_model AND tag_model.id_tag = category_tag.id AND category.id = category_tag.id_category AND model.name <> '' LIMIT 0 , 30";								
                                  $vysledek=$this->query($dotaz);
                                                                  
                                                                  	while($radek = MySQL_Fetch_Array($vysledek))
                                                        						{
                                                                      echo $radek['category.name'].$radek['category_tag.value']."</br>";
                                                       						  } ;
}



public function return_visits($id)
{
                                  $dotaz = "SELECT * FROM model WHERE id=".$id;								
                                  $vysledek=$this->query($dotaz);
                                                                  
                                                                  	while($radek = MySQL_Fetch_Array($vysledek))
                                                        						{
                                                                      $count=$radek['visits'];
                                                       						  } ;
                                                                    return $count;

}


public function search($what)
{

                                  $dotaz = "SELECT * FROM `model` WHERE name like  '%".$what."%' ORDER BY name DESC ";								
                                  $vysledek=$this->query($dotaz);
                                                                  
                                                                  	while($radek = MySQL_Fetch_Array($vysledek))
                                                        						{
                                                                    //výpis imageboxů
                                                                      echo "<div id='imagebox'><a href='model.php?id=".$radek['id']."' class='box'><img src='images/noimage.png' border=\"1\"></br>".$radek['name']."</a></div></br>";
                                                       						  } ;
}


public function login()
{
                $error_message="";
                $hes = isset($_POST["passwd"]) ? $_POST["passwd"] : null;
                $email = isset($_POST["email"]) ? $_POST["email"] : null;
                $heslo="" ;
                $výsledek = $this->query("SELECT user.id as id, email, password, type FROM user,contact WHERE contact.id=id_contact AND email = '".$email."'");
                  while ($řádek = mysql_fetch_array($výsledek))
                  {     
                      $heslo = $řádek["password"];
                      $id = $řádek["id"];
                      $type = $řádek["type"];
                      $email = $řádek["email"];
                      
                  }
                  
                
                
                $pass = $heslo;
                $hes1 = $hes;
                $heslo2 = hash('sha256', $hes1);
                
                if (isset($_GET['action']) && $_GET['action']=='validate'){
                if(!$this->check_mail($_POST["email"])) $error_message=$error_message."špatný formát emailu,";; 
                if(($heslo2==$pass))
                {     
                      $user=new User();
                      $user->session_reg($id,$email,$type);
                       
                      //$this->error("vše OK!");
                      header("Location: home.php");
                     exit;
                   
                 }
                 else { 
                 
                    $error_message=$error_message." špatné heslo nebo email";;
                } ;
                if($error_message<>"")$this->error($error_message.".");
                }
}

public function update_layer(){
                  //id
                  $id=isset($_GET['id']) ?  $_GET['id'] : null;
                  //action indentifikator
                  $action=isset($_GET['action']) ?  $_GET['action'] : null;
                  //měritko
                  $scale=isset($_POST['scale']) ?  $_POST['scale'] : 1;
                  //lokace
                  $locx=isset($_POST['locx']) ?  $_POST['locx'] : 0;
                  $locy=isset($_POST['locy']) ?  $_POST['locy'] : 0;
                  $locz=isset($_POST['locz']) ?  $_POST['locz'] : 0;
                  //rotace
                  $rotx=isset($_POST['rotx']) ?  $_POST['rotx'] : 0;
                  $roty=isset($_POST['roty']) ?  $_POST['roty'] : 0;
                  $rotz=isset($_POST['rotz']) ?  $_POST['rotz'] : 0;
                  //převod stupnů na radiány
                  $rotx=deg2rad($rotx);
                  $roty=deg2rad($roty);
                  $rotz=deg2rad($rotz);
                  
                  if($action=='send') {
                  $dotaz = "UPDATE layer SET scale='".$scale."',rotx='".$rotx."',roty='".$roty."',rotz='".$rotz."',locx='".$locx."',locy='".$locy."',locz='".$locz."' WHERE id='".$id."'";								
                  $this->query($dotaz);
                  header("Cache-Control: no-cache");
                  echo '<p id="green">layer updated</p>';
                  };  


}


public function delete_layer(){
                  //id
                  $id=isset($_GET['id']) ?  $_GET['id'] : null;
                  //action indentifikator
                  $action=isset($_GET['action']) ?  $_GET['action'] : null;
                  
                  
                  if($action=='send') {
                  $dotaz = "DELETE FROM layer WHERE id='".$id."'";								
                  $this->query($dotaz);
                  echo '<p id="green">layer deleted</p>';
                  };  


}

}





?>