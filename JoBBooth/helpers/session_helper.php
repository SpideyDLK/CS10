<?php
if(!isset($_SESSION)){
    session_start();
}

function redirect($location){
    header("location: ".$location);
    exit();
}

function popUp($name = '', $message = '', $class = 'popUp'){
    if(!empty($name)){
        if(!empty($message) && empty($_SESSION[$name])){
            $_SESSION[$name] = $message;
            $_SESSION[$name.'_class'] = $class;
        }else if(empty($message) && !empty($_SESSION[$name])){
            echo '<div id="popup" class="'.$class.'" >'.$_SESSION[$name].'</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
            return true;
        }
    }
}