<?php

class Lagu extends DB
{
    function getLaguJoin()
    {
        $query = "SELECT * FROM lagu JOIN agensi ON lagu.id_agensi = agensi.id_agensi JOIN idol ON lagu.id_idol = idol.id_idol ORDER BY lagu.id_lagu";

        return $this->execute($query);
    }

    function getLagu()
    {
        $query = "SELECT * FROM lagu";
        return $this->execute($query);
    }

    function getLaguById($id_lagu)
    {
        $query = "SELECT * FROM lagu JOIN agensi ON lagu.id_agensi = agensi.id_agensi JOIN idol ON lagu.id_idol = idol.id_idol WHERE id_lagu = $id_lagu";
        return $this->execute($query);
    }

    function searchLagu($keyword)
    {
        $query = "SELECT * FROM lagu JOIN agensi ON lagu.id_agensi=agensi.id_agensi JOIN idol ON lagu.id_idol=idol.id_idol WHERE judul LIKE '%$keyword%' OR nama_agensi LIKE '%$keyword%' OR nama_idol LIKE '%$keyword%' ORDER BY lagu.id_lagu;";
        return $this->execute($query);
    }

    function addLagu($data, $file)
    {
        $foto = $file['foto']['name'];
        $temp_foto = $file['foto']['tmp_name'];
        $folder = 'assets/images/' . $foto;
        $isMoved = move_uploaded_file($temp_foto, $folder);
        if (!$isMoved) {
            $foto = 'default.jpg';
        }
        $judul = $data['judul'];
        $nama_album = $data['nama_album'];
        $tahun_keluar = $data['tahun_keluar'];
        $deskripsi = $data['deskripsi'];
        $agensi = $data['agensi'];
        $idol = $data['idol'];

        $query = "INSERT INTO lagu VALUES('', '$judul', '$nama_album', '$tahun_keluar', '$deskripsi', '$foto', '$agensi', '$idol');";

        return $this->executeAffected($query);
    }

    function updateLagu($id_lagu, $data, $file)
    {
        $foto = $file['foto']['name'];
        $temp_foto = $file['foto']['tmp_name'];
        $folder = 'assets/images/' . $foto;
        move_uploaded_file($temp_foto, $folder);
        // if (!$isMoved) {
        //     $foto = 'default.jpg';
        // }

      //  $id_lagu = $data['id_lagu'];
        $judul = $data['judul'];
        $nama_album = $data['nama_album'];
        $tahun_keluar = $data['tahun_keluar'];
        $deskripsi = $data['deskripsi'];
        $agensi = $data['agensi'];
        $idol = $data['idol'];

        $query = "UPDATE lagu SET judul='$judul', nama_album='$nama_album', tahun_keluar='$tahun_keluar',
            deksripsi='$deskripsi', 
            foto='$foto',
            id_agensi='$agensi',
            id_idol='$idol'
            WHERE id_lagu= $id_lagu";
            return $this->executeAffected($query);
    }

    function deleteLagu($id_lagu)
    {
        $query = "DELETE FROM lagu WHERE id_lagu=$id_lagu";
        return $this->executeAffected($query);
    }
}
