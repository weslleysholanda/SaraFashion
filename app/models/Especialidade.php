<?php
class Especialidade extends Model {
    
    public function getListarEspecialidade() {
        $sql = "SELECT * FROM tbl_especialidade WHERE status_especialidade = 'Ativo' ORDER BY nome_especialidade ASC;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEspecialidadeById($id)
    {
        $sql = "SELECT * FROM tbl_especialidade WHERE id_especialidade = :id_especialidade;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_especialidade', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getEspecialidadeByStatus($status)
    {
        $sql = "SELECT * FROM tbl_especialidade WHERE status_especialidade = :status";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizarEspecialidade($id, $dados)
    {
        $sql = "UPDATE tbl_especialidade 
        SET nome_especialidade = :nome_especialidade 
        WHERE id_especialidade = :id_especialidade";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_especialidade', $dados['nome_especialidade']);

        $stmt->bindValue(':id_especialidade', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function desativarEspecialidade($id)
    {
        $sql = "UPDATE tbl_especialidade SET status_especialidade = 'Inativo' WHERE id_especialidade = :id_especialidade";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_especialidade', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function ativarEspecialidade($id)
    {
        $sql = "UPDATE tbl_especialidade SET status_especialidade = 'Ativo' WHERE id_especialidade = :id_especialidade";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_especialidade', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
