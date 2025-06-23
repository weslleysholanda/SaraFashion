<?php

class Agendamento extends Model
{
    public function ListarAgendamento($id_cliente)
    {
        $sql = "SELECT 
        tbl_agendamento.id_agendamento,
        tbl_agendamento.data_agendamento,
        tbl_agendamento.id_cliente,
        tbl_agendamento.id_servico,
        tbl_agendamento.status_agendamento,
        tbl_servico.nome_servico,
        tbl_servico.tempo_estimado_servico,
        tbl_servico.foto_servico,
        tbl_servico.alt_foto_servico
        FROM tbl_agendamento
        INNER JOIN tbl_servico ON tbl_agendamento.id_servico = tbl_servico.id_servico
        WHERE tbl_agendamento.status_agendamento = 'Agendado'
        AND tbl_agendamento.id_cliente = :id_cliente;
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_cliente' => $id_cliente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionarAgendamento(array $dados)
    {
        $sql = "INSERT INTO tbl_agendamento 
                (id_cliente, id_servico, data_agendamento, status_agendamento) 
                VALUES 
                (:id_cliente, :id_servico, :data_agendamento, :status_agendamento)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id_cliente', $dados['id_cliente'], PDO::PARAM_INT);
        $stmt->bindValue(':id_servico', $dados['id_servico'], PDO::PARAM_INT);
        $stmt->bindValue(':data_agendamento', $dados['data_agendamento']);
        $stmt->bindValue(':status_agendamento', $dados['status_agendamento']);

        return $stmt->execute();
    }

    public function cancelarAgendamento($id)
    {
        $sql = "UPDATE tbl_agendamento SET status_agendamento = 'Cancelado' WHERE id_agendamento= :id_agendamento";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_agendamento', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function listarHistoricoServico($id_cliente)
    {
        $sql = "SELECT 
            tbl_agendamento.id_agendamento,
            tbl_agendamento.data_agendamento,
            tbl_agendamento.id_cliente,
            tbl_agendamento.id_servico,
            tbl_agendamento.status_agendamento,
            tbl_servico.nome_servico,
            tbl_servico.tempo_estimado_servico,
            tbl_servico.foto_servico,
            tbl_servico.alt_foto_servico
            FROM tbl_agendamento
            INNER JOIN tbl_servico ON tbl_agendamento.id_servico = tbl_servico.id_servico
            WHERE tbl_agendamento.id_cliente = :id_cliente
            ORDER BY tbl_agendamento.status_agendamento ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_cliente' => $id_cliente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
