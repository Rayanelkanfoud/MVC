<?php

class Sneaker
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllSneakers()
    {
        $sql = "SELECT  SNK.Merk
                        ,SNK.Model
                        ,SNK.Type
                        ,SNK.Prijs
                        ,SNK.Materiaal
                        ,CONCAT(SNK.Gewicht, ' kg') AS Gewicht
                        ,DATE_FORMAT(SNK.Releasedatum, '%d/%m/%Y') AS Releasedatum
                FROM    Sneakers AS SNK
                ORDER BY SNK.Type ASC
                        ,SNK.Merk ASC
                        ,SNK.Model ASC";

        $this->db->query($sql);

        return $this->db->resultSet();
    }
}