<?php

class Smartphone
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllSmartphones()
    {
        $sql = "SELECT  SMPS.Merk
                        ,SMPS.Model
                        ,SMPS.Prijs
                        ,SMPS.Geheugen
                        ,SMPS.Besturingssysteem
                        ,CONCAT(SMPS.Schermgrootte, ' inch') AS Schermgrootte
                        ,DATE_FORMAT(SMPS.Releasedatum, '%d/%m/%Y') AS Releasedatum
                        ,CONCAT(SMPS.MegaPixels, ' MP') AS MegaPixels
                FROM    Smartphones AS SMPS
                ORDER BY SMPS.Schermgrootte DESC
                        ,SMPS.Prijs DESC
                        ,SMPS.Geheugen DESC
                        ,SMPS.Releasedatum DESC
                        ,SMPS.MegaPixels DESC";

        $this->db->query($sql);

        return $this->db->resultSet();
    }
}