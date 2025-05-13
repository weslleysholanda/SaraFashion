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

    public function getServicoByStatus($status)
    {
        $sql = "SELECT * FROM tbl_servico inner join tbl_especialidade ON tbl_servico.id_especialidade = tbl_especialidade.id_especialidade WHERE status_servico = :status;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

    public function addServico($dados)
    {
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

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_servico', $dados['nome_servico']);
        $stmt->bindValue(':descricao_servico', $dados['descricao_servico']);
        $stmt->bindValue(':preco_base_servico', $dados['preco_base_servico']);
        $stmt->bindValue(':tempo_estimado_servico', $dados['tempo_estimado_servico']);
        $stmt->bindValue(':foto_servico', $dados['foto_servico']);
        $stmt->bindValue(':alt_foto_servico', $dados['alt_foto_servico']);
        $stmt->bindValue(':id_especialidade', $dados['id_especialidade']);
        $stmt->bindValue(':status_servico', $dados['status_servico']);

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function atualizarServico($id, $dados)
    {
        $sql = "UPDATE tbl_servico 
                SET nome_servico = :nome_servico,
                    descricao_servico = :descricao_servico,
                    preco_base_servico = :preco_base_servico,
                    tempo_estimado_servico = :tempo_estimado_servico,
                    alt_foto_servico = :alt_foto_servico,
                    id_especialidade = :id_especialidade,
                    status_servico = :status_servico";
    
        // Se houver uma nova foto, adicionamos o campo foto_servico
        if (!empty($dados['foto_servico'])) {
            $sql .= ", foto_servico = :foto_servico";
        }
    
        $sql .= " WHERE id_servico = :id_servico";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_servico', $dados['nome_servico']);
        $stmt->bindValue(':descricao_servico', $dados['descricao_servico']);
        $stmt->bindValue(':preco_base_servico', $dados['preco_base_servico']);
        $stmt->bindValue(':tempo_estimado_servico', $dados['tempo_estimado_servico']);
        $stmt->bindValue(':alt_foto_servico', $dados['alt_foto_servico']);
        $stmt->bindValue(':id_especialidade', $dados['id_especialidade']);
        $stmt->bindValue(':status_servico', $dados['status_servico']);
    
        // Se houver uma nova foto, associamos o valor à query
        if (!empty($dados['foto_servico'])) {
            $stmt->bindValue(':foto_servico', $dados['foto_servico']);
        }
    
        $stmt->bindValue(':id_servico', $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    

    public function desativarServico($id)
    {
        $sql = "UPDATE tbl_servico SET status_servico = 'Inativo' WHERE id_servico = :id_servico";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_servico', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function ativarServico($id)
    {
        $sql = "UPDATE tbl_servico SET status_servico = 'Ativo' WHERE id_servico = :id_servico";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_servico', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function obterOuCriarEspecialidade($nome)
    {
        $sql = "INSERT INTO tbl_especialidade(nome_especialidade) VALUES (:nome)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function getServicoById($id)
    {
        $sql = "SELECT s.*, e.nome_especialidade 
                FROM tbl_servico s
                INNER JOIN tbl_especialidade e ON s.id_especialidade = e.id_especialidade
                WHERE s.id_servico = :id_servico
                LIMIT 1;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_servico', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
