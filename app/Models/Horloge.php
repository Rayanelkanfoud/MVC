<?php

class Horloge
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllHorloges()
    {
        $sql = "SELECT  HRL.Id
                        ,HRL.Merk
                        ,HRL.Model
                        ,HRL.Prijs
                        ,HRL.Materiaal
                        ,CONCAT(HRL.Gewicht, ' g') AS Gewicht
                        ,DATE_FORMAT(HRL.Releasedatum, '%d/%m/%Y') AS Releasedatum
                FROM    Horloges AS HRL
                ORDER BY HRL.Merk ASC
                        ,HRL.Model ASC";

        $this->db->query($sql);

        return $this->db->resultSet();
    }

    public function delete($Id)
    {
        $sql = "DELETE
                FROM Horloges
                WHERE Id = :Id";

        $this->db->query($sql);
        $this->db->bind(':Id', $Id, PDO::PARAM_INT);

        return $this->db->execute();
    }
}