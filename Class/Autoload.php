<?php

class Autoload {
    public static function load(){
        spl_autoload_register(function ($className){
            if(file_exists('Class/' . $className . '.php')){
                require_once 'Class/' . $className . '.php';
            } 
            else if(file_exists('Controllers/' . $className . '.php')){
                require_once 'Controllers/' . $className . '.php';
            } 
            else if(file_exists('Views/' . $className . '.php')){
                require_once 'Views/' . $className . '.php';
            } 
            else if(file_exists('Models/' . $className . '.php')){
                require_once 'Models/' . $className . '.php';
            }
        });
    }
}