<?php

class Idol extends DB
{
    function getIdol()
    {
        $query = "SELECT * FROM idol";
        return $this->execute($query);
    }

    function getIdolById($id_idol)
    {
        $query = "SELECT * FROM idol WHERE id_idol=$id_idol";
        return $this->execute($query);
    }

    function addIdol($data)
    {
        $nama_idol = $data['nama'];
        $foto_idol = $data['foto'];
        $query = "INSERT INTO idol VALUES('', '$nama_idol', '$foto_idol')";
        return $this->executeAffected($query);
    }

    function updateIdol($id_idol, $data)
    {
        $nama_idol = $data['nama'];
        $foto_idol = $data['foto'];
        $query = "UPDATE idol SET nama_idol ='$nama_idol', foto_idol = '$foto_idol' WHERE id_idol = $id_idol";
        return $this->executeAffected($query);
    }

    function deleteIdol($id_idol)
    {
        $query = "DELETE FROM idol WHERE id_idol = $id_idol";
        return $this->executeAffected($query);
    }
}
