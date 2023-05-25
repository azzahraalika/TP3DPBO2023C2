<?php

class Agensi extends DB
{
    function getAgensi()
    {
        $query = "SELECT * FROM agensi";
        return $this->execute($query);
    }

    function getAgensiById($id_agensi)
    {
        $query = "SELECT * FROM agensi WHERE id_agensi=$id_agensi";
        return $this->execute($query);
    }

    function addAgensi($data)
    {
        $nama_agensi = $data['nama'];
        $foto_agensi = $data['foto'];
        $query = "INSERT INTO agensi VALUES('', '$nama_agensi', '$foto_agensi')";
        return $this->executeAffected($query);
    }

    function updateAgensi($id_agensi, $data)
    {
        $nama_agensi = $data['nama'];
        $foto_agensi = $data['foto'];
        $query = "UPDATE agensi SET nama_agensi ='$nama_agensi', foto_agensi ='$foto_agensi' WHERE id_agensi = $id_agensi";
        return $this->executeAffected($query);
    }
   
    function deleteAgensi($id_agensi)
    {
        $query = "DELETE FROM agensi WHERE id_agensi = $id_agensi";
        return $this->executeAffected($query);
    }
}
