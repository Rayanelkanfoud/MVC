<?php

class Zangeressen
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllZangeressen()
    {
        $sql = "SELECT  ZNG.Id
                        ,ZNG.Naam
                        ,ZNG.Geboorteland
                        ,ZNG.Vermogen
                        ,ZNG.Genre
                        ,DATE_FORMAT(ZNG.Geboortedatum, '%d/%m/%Y') AS Geboortedatum
                FROM Zangeressen AS ZNG
                ORDER BY ZNG.Vermogen DESC";

        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function delete($Id)
    {
        $sql = "DELETE FROM Zangeressen
                WHERE Id = :Id";

        $this->db->query($sql);
        $this->db->bind(':Id', $Id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function create($data)
    {
        $sql = "INSERT INTO Zangeressen
                (
                    Naam,
                    Geboorteland,
                    Vermogen,
                    Genre,
                    Geboortedatum
                )
                VALUES
                (
                    :naam,
                    :geboorteland,
                    :vermogen,
                    :genre,
                    :geboortedatum
                )";

        $this->db->query($sql);
        $this->db->bind(':naam', $data['naam'], PDO::PARAM_STR);
        $this->db->bind(':geboorteland', $data['geboorteland'], PDO::PARAM_STR);
        $this->db->bind(':vermogen', $data['vermogen'], PDO::PARAM_STR);
        $this->db->bind(':genre', $data['genre'], PDO::PARAM_STR);
        $this->db->bind(':geboortedatum', $data['geboortedatum'], PDO::PARAM_STR);

        return $this->db->execute();
    }

    public function getZangeresById($id)
    {
        $sql = "SELECT  ZNG.Id
                        ,ZNG.Naam
                        ,ZNG.Geboorteland
                        ,ZNG.Vermogen
                        ,ZNG.Genre
                        ,ZNG.Geboortedatum
                FROM Zangeressen AS ZNG
                WHERE ZNG.Id = :id";

        $this->db->query($sql);
        $this->db->bind(':id', $id, PDO::PARAM_INT);

        return $this->db->single();
    }

    public function updateZangeres($request)
    {
        $sql = "UPDATE Zangeressen AS ZNG
                SET     ZNG.Naam = :naam,
                        ZNG.Geboorteland = :geboorteland,
                        ZNG.Vermogen = :vermogen,
                        ZNG.Genre = :genre,
                        ZNG.Geboortedatum = :geboortedatum
                WHERE   ZNG.Id = :id";

        $this->db->query($sql);
        $this->db->bind(':id', $request['id'], PDO::PARAM_INT);
        $this->db->bind(':naam', $request['naam'], PDO::PARAM_STR);
        $this->db->bind(':geboorteland', $request['geboorteland'], PDO::PARAM_STR);
        $this->db->bind(':vermogen', $request['vermogen'], PDO::PARAM_STR);
        $this->db->bind(':genre', $request['genre'], PDO::PARAM_STR);
        $this->db->bind(':geboortedatum', $request['geboortedatum'], PDO::PARAM_STR);

        return $this->db->execute();
    }
}
