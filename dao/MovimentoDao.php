<?php

require_once 'Conexao.php';
require_once 'UTILdao.php';

class MovimentoDAO extends Conexao
{

    public function ExcluirMovimento($idMov)
    {

        $conexao = parent::retornarConexao();

        $comando_sql = 'select 
                               mo.tipo_movimento,
                               mo.valor_movimento,
                               mo.id_conta
                        from tb_movimento as mo
                          where mo.id_movimento = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idMov);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        $movs =  $sql->fetchAll();

        $conexao->beginTransaction();

        try {

            $comando_sql = 'delete from tb_movimento where id_movimento = ?';
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $idMov);
            //Exclui o mov
            $sql->execute();

            //Verifica se é uma entrada ou saida
            if ($movs[0]['tipo_movimento'] == 0) {
                $comando_sql = 'update tb_conta set saldo_conta = saldo_conta - ? where id_conta = ?';
            } else if ($movs[0]['tipo_movimento'] == 1) {
                $comando_sql = 'update tb_conta set saldo_conta = saldo_conta + ? where id_conta = ?';
            }

            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $movs[0]['valor_movimento']);
            $sql->bindValue(2, $movs[0]['id_conta']);

            //Atualiza o saldo
            $sql->execute();

            //Confirmar a transação
            $conexao->commit();

            return 1;

        } catch (Exception $ex) {
            $conexao->rollBack();
            return -1;
        }
    }

    public function CadastrarMovimento($tipo_movimento, $data, $categoria, $conta, $empresa, $valor, $Observação)
    {
        if (trim($tipo_movimento) == "" || trim($data) == "" || trim($categoria) == "" || trim($conta) == "" || trim($empresa) == "" || trim($valor) == "") {
            return 0;
        }
        $conexao = parent::retornarConexao();
        $comando_sql = 'insert into tb_movimento(tipo_movimento, data_movimento, valor_movimento, obs_movimento, 
                    id_empresa, id_conta, id_categoria, tb_usuario_id_usuario) values(?,?,?,?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindvalue(1, $tipo_movimento);
        $sql->bindvalue(2, $data);
        $sql->bindvalue(3, $valor);
        $sql->bindvalue(4, $Observação);
        $sql->bindvalue(5, $empresa);
        $sql->bindvalue(6, $conta);
        $sql->bindvalue(7, $categoria);
        $sql->bindvalue(8, UtilDAO::CodigoLogado());
        $conexao->beginTransaction();

        try {
            $sql->execute();

            if ($tipo_movimento == 0) {
                $comando_sql = 'update tb_conta set saldo_conta = saldo_conta + ? where id_conta = ?';
            } else {
                $comando_sql = 'update tb_conta set saldo_conta = saldo_conta - ? where id_conta = ?';
            }

            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $valor);
            $sql->bindvalue(2, $conta);

            $sql->execute();

            $conexao->commit();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollback();
            return -1;
        }
    }
    public function PesquisarMovimento($tipo, $dtInicial, $dtFinal)
    {
        if (trim($dtInicial) == '' || trim($dtFinal) == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'select mo.id_movimento,
                               mo.tipo_movimento,
                               mo.valor_movimento,
                               mo.data_movimento,
                               ca.nome_categoria,
                               em.nome_empresa,
                               co.banco_conta,
                               co.agencia_conta,
                               co.numero_conta,
                               mo.obs_movimento
                        from tb_movimento as mo
                  inner join tb_categoria as ca
                          on mo.id_categoria = ca.id_categoria
                  inner join tb_empresa as em
                          on mo.id_empresa = em.id_empresa
                  inner join tb_conta as co
                          on mo.id_conta = co.id_conta
                          where mo.tb_usuario_id_usuario = ?
                          and mo.data_movimento between ? and ?';
        if ($tipo != 2) {
            $comando_sql .= ' and mo.tipo_movimento = ?';
        }

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->bindValue(2, $dtInicial);
        $sql->bindValue(3, $dtFinal);

        if ($tipo != 2) {
            $sql->bindValue(4, $tipo);
        }

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }
}
