<?php

class Dashboard extends Model{

    public function getUsuarioLogado($idFuncionario){
        $sql = "SELECT * FROM tbl_funcionario INNER JOIN tbl_especialidade ON tbl_funcionario.id_especialidade = tbl_especialidade.id_especialidade WHERE tbl_funcionario.id_funcionario = :id AND status_funcionario = 'Ativo';";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $idFuncionario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($resultado) {
            //DateTime manipula a data
            // format('M.Y') transforma a data no formato desejado
            $datAdm = new DateTime($resultado['data_adm_funcionario']);
            $resultado['membro_desde'] = 'Membro Desde' . $datAdm->format('M.Y');
        }

        return $resultado;
    }


    public function getDepoimento(){
        $sql = "SELECT COUNT(*) AS total_depoimentos FROM tbl_avaliacao WHERE status_avaliacao = 'Aprovado';";
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total_depoimentos'];
    }

    public function getTotalRegistros(){
        $sql = "SELECT (SELECT COUNT(*) FROM tbl_cliente WHERE status_cliente = 'Ativo') + (SELECT COUNT(*) FROM tbl_funcionario WHERE status_funcionario = 'Ativo') AS total_cadastro;";
        $stmt = $this->db->query($sql);
        $resultado= $stmt ->fetch(PDO::FETCH_ASSOC);
        return $resultado['total_cadastro'];
    }

    public function getVendas(){
        $sql = "SELECT COUNT(*) as total_vendas FROM tbl_venda;";
        $stmt = $this -> db->query($sql);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total_vendas'];

    }
}
