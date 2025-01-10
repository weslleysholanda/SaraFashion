<?php 

class Marcas extends Model{

    public function getLogoNome(){

        $sql = 'SELECT * FROM tbl_marcas';
        $stmt = $this -> db -> query($sql);
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
}