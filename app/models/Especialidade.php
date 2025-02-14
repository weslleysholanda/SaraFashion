<?php
class Especialidade extends Model{
    
    public function getListarEspecialidade(){
        $sql = "SELECT * FROM tbl_especialidade";
        $stmt = $this->db->query($sql);
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
}