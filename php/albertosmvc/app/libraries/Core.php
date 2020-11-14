<?php

/**
 * App Core Klasse
 * Die App Core Klasse generiert die URL und lädt den Core Controller
 * Das URL FORMAT ist wie folgt - /controller/method/params
 */

 class Core {

    protected $currentController = "Pages";
    protected $currentMethod = "index";
    protected $params = [];

    public function __construct() {
        /* print_r($this->getURL()); */

        $url = $this->getURL();

        // Es wird geprüft, ob der von der URL aufgerufener Controller existiert
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {

            // falls die Controller Klasse existiert, wird der current controller
            // geändert
            $this->currentController = ucwords($url[0]);

            // Der Index wird wieder auf 0 gesetzt
            unset($url[0]);
        }

        // Der aufgerufene Controller wird importiert
        require_once('../app/controllers/'. $this->currentController.'.php');

        // Die Klasse wird instanziert
        $this->currentController = new $this->currentController;

        // Prüfen, ob es einen zweiten URL Parameter gibt
        if(isset($url[1])) {

            // Prüfen, ob es die Funktion in der Controller Klasse gibt
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }  
           
        }
        
        // Prüfen ob es weitere Parameter gibt und diese in einem Array speichern
        $this->params = $url ? array_values($url) : [];

        // Ein Callback mit den weitere URL Parameter
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    private function getURL() {
        
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            /* print_r($url); */
            return $url;
        }
    }



 }