<?php

class Agendamento extends Model
{
    public function ListarAgendamento()
    {
        $sql = "SELECT  tbl_agendamento.id_agendamento,
                tbl_cliente.nome_cliente,
                tbl_cliente.foto_cliente,
                tbl_cliente.alt_foto_cliente,
                tbl_funcionario.nome_funcionario,
                tbl_servico.nome_servico,
                tbl_agendamento.data_agendamento,
                tbl_agendamento.status_agendamento
                FROM tbl_agendamento
                INNER JOIN 
                tbl_cliente ON tbl_agendamento.id_cliente = tbl_cliente.id_cliente
                INNER JOIN 
                tbl_funcionario ON tbl_agendamento.id_funcionario = tbl_funcionario.id_funcionario
                INNER JOIN 
                tbl_servico ON tbl_agendamento.id_servico = tbl_servico.id_servico";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function cancelarAgendamento($id){
        $sql = "UPDATE tbl_agendamento SET status_agendamento = 'Cancelado' WHERE id_agendamento= :id_agendamento";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_agendamento',$id,PDO::PARAM_INT);
        return $stmt->execute();
    }
}
