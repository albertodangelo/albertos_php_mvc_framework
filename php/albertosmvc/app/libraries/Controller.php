<?php

class Controller {

    // lädt die Views
    public function model($model) {

        // holt die Files
        require_once('../app/models/'.$model.'.php');

        // instanziert die Klassen
        return new $model();
    }

    // lädt die Controllers
    public function view($view, $data = []){

       
        // prüft ob der View, resp. das File existiert und lädt ihn
        if(file_exists('../app/views/'. $view . '.php')) {
           
            require_once('../app/views/'. $view . '.php'); 
          
        } else {
            die("Diese Ansicht existiert nicht.");
        }

    }
}