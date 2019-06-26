<?php
Class User
{ 
var $type;
public function session_reg($id,$email,$type){
                      session_start();
                      session_register("id");
                      session_register("mail");
                      session_register("type"); 
                      $_SESSION["id"]=$id;
                      $_SESSION["mail"]=$email;
                      $_SESSION["type"]=$type;
                      $this->type=$type;
}

// funkce prevzata z http://forums.oscommerce.com/topic/343898-deprecated-function-session-is-registered-is-deprecated/
private function tep_session_is_registered($variable) {
        if (PHP_VERSION < 4.3) {
          return session_is_registered($variable);
        } else {
          return isset($_SESSION) && array_key_exists($variable, $_SESSION);
        }
  }

public function session(){
                              session_start();
                              if (!$this->tep_session_is_registered('id'))header("location:index.php"); 
}


public function end_session() {
unset($_SESSION['id']);
unset($_SESSION['mail']);
unset($_SESSION['type']);
session_destroy();
}

}







?>