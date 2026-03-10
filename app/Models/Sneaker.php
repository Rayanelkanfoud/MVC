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
        $sql = "SELECT  SNK.Id
                        ,SNK.Merk
                        ,SNK.Model
                        ,SNK.Type
                        ,SNK.Prijs
                        ,SNK.Materiaal
                        ,CONCAT(SNK.Gewicht, ' kg') AS Gewicht
                        ,DATE_FORMAT(SNK.Releasedatum, '%d/%m/%Y') AS Releasedatum
                FROM Sneakers AS SNK
                ORDER BY SNK.Prijs DESC";

        $this->db->query($sql);

        return $this->db->resultSet();
    }

    public function delete($Id)
    {
        $sql = "DELETE
                FROM Sneakers
                WHERE Id = :Id";

        $this->db->query($sql);
        $this->db->bind(':Id', $Id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function create($data)
    {
        $sql = "INSERT INTO Sneakers
                (
                    Merk,
                    Model,
                    Type,
                    Prijs,
                    Materiaal,
                    Gewicht,
                    Releasedatum
                )
                VALUES
                (
                    :merk,
                    :model,
                    :type,
                    :prijs,
                    :materiaal,
                    :gewicht,
                    :releasedatum
                )";

        $this->db->query($sql);
        $this->db->bind(':merk', $data['merk'], PDO::PARAM_STR);
        $this->db->bind(':model', $data['model'], PDO::PARAM_STR);
        $this->db->bind(':type', $data['type'], PDO::PARAM_STR);
        $this->db->bind(':prijs', $data['prijs'], PDO::PARAM_STR);
        $this->db->bind(':materiaal', $data['materiaal'], PDO::PARAM_STR);
        $this->db->bind(':gewicht', $data['gewicht'], PDO::PARAM_STR);
        $this->db->bind(':releasedatum', $data['releasedatum'], PDO::PARAM_STR);

        return $this->db->execute();
    }
}