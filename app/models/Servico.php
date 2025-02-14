<?php

class Servico extends Model
{

    public function getServicoAleatorio($limite = 3)
    {
        $sql = "SELECT * FROM tbl_servico where status_servico = 'Ativo' ORDER BY RAND() LIMIT :limite";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getServicoAll()
    {
        $sql = "SELECT * FROM tbl_servico INNER JOIN tbl_especialidade ON tbl_servico.id_especialidade = tbl_especialidade.id_especialidade WHERE status_servico = 'Ativo' ORDER BY nome_servico ASC;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addServico($dados){
        $sql = "INSERT INTO tbl_servico(
        nome_servico,
        descricao_servico,
        preco_base_servico,
        tempo_estimado_servico,
        foto_servico,
        alt_foto_servico,
        id_especialidade,
        status_servico
        ) VALUES (
        :nome_servico,
        :descricao_servico,
        :preco_base_servico,
        :tempo_estimado_servico,
        :foto_servico,
        :alt_foto_servico,
        :id_especialidade,
        :status_servico)";

        $stmt = $this->db ->prepare($sql);

        $stmt->bindValue(':nome_servico',$dados['nome_servico']);
        $stmt->bindValue(':descricao_servico',$dados['descricao_servico']);
        $stmt->bindValue(':preco_base_servico',$dados['preco_base_servico']);
        $stmt->bindValue(':tempo_estimado_servico',$dados['tempo_estimado_servico']);
        $stmt->bindValue(':foto_servico',$dados['foto_servico']);
        $stmt->bindValue(':alt_foto_servico',$dados['alt_foto_servico']);
        $stmt->bindValue(':id_especialidade',$dados['id_especialidade']);
        $stmt->bindValue(':status_servico',$dados['status_servico']);

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function obterOuCriarEspecialidade($nome){
        $sql = "INSERT INTO tbl_especialidade(nome_especialidade) VALUES (:nome)";
        $stmt= $this->db->prepare($sql);
        $stmt->bindValue(':nome',$nome);
        if($stmt->execute()){
            return $this-> db ->lastInsertId();
        }
        return false;
    }

}
