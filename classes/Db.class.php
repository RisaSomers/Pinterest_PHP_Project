<?php

abstract class Db{

    private static $conn = NULL;

    public static function getInstance(){ //bij static moet je geen object maken maar meteen aanspreken

        if( isset( self::$conn ) ){ // geen $this omdat er geen huidig obejct is, self kijkt naar de basis klasse
            // er is al connectie, geen deze terug
            return self::$conn;
        }

        else{
            // er is nog connectie, maak aan en geef terug


            self::$conn = new PDO("mysql:host=localhost;dbname=pinterest_php","root","root");


            return self::$conn;
        }

        // :: zijn statische functies zodat je geen onnodige zaken moet coderen

    }
}
