<?php

/**
 * PDO Datenbank Klasse
 * Stellt Datenbankverbindung her
 * Erstellt "prepared statements" (gegen SQL-Injections)
 * Verbindet Werte
 * Gibt DB-Einträge und "rows" zurück
 */

 class Database {

    // Datenbank Parameter
    private $servername = DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;
    private $port = DB_PORT;



    private $dbh;
    private $stmt;
    private $error;

    public function __construct () {
    
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // PDO Instanz wird generiert
        try {
           
            $this->dbh =  new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname",$this->username,$this->password);

           
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * Vorbereitung des Prepare Statements
     */
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Eingabe-Werte mit mit "bind" mappen 
     * Um SQL Inection zu verhindern, werden die Typen geprüft
     */
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {

            switch(true) {
                case is_int($value): 
                    $type = PDO::PARAM_INT;
                break;
                case is_bool($value): 
                    $type = PDO::PARAM_BOOL;
                break;
                case is_null($value): 
                    $type = PDO::PARAM_NULL;
                break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Prepared Statement ausführen "execute"
     */
    public function execute() {
        return $this->stmt->execute();
    }

    /**
     * Datenbankabfrage - Resultat-Set mit "fetchAll" (Array aus Objekten)
     */
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Datenbankabfrage - Resultat einzelner Eintrag "fetch" (1 Objekt)
     */
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Datenbankabfrage - Anzahl der Eintrage "rowCount"
     */
    public function rowCount() {
        return $this->stmt->rowCount();
    }

 }