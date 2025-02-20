<?php
class Especialidade extends Model {
    
    public function getListarEspecialidade() {
        $sql = "SELECT * FROM tbl_especialidade ORDER BY nome_especialidade ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
