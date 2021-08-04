<?php

require_once 'Conexao.php';
require_once 'UTILdao.php';

class ContaDao extends Conexao
{

    public function ConsultarConta(){
        
        $Conexao = parent::retornarConexao();
        $comando_sql = 'select id_conta, banco_conta, tipo_conta, agencia_conta,
                        numero_conta, saldo_conta from tb_conta where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $Conexao->prepare($comando_sql);
        $sql->bindValue(1,UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();



    }

    public function CadastrarConta($nome_banco, $tipo_conta, $agencia_conta, $numero_conta, $saldo_conta)
    {
        if (
            trim($nome_banco) == "" || trim($tipo_conta) == "" || trim($saldo_conta) == "" || trim($agencia_conta) == "" ||
            trim($numero_conta) == ""
        ) {
            return 0;
        }

        $Conexao = parent::retornarConexao();
        $comando_sql = 'insert into tb_conta (banco_conta, tipo_conta, agencia_conta, 
                        numero_conta, saldo_conta, id_usuario) 
                        value(?,?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $Conexao->prepare($comando_sql);
        $sql->bindvalue(1,$nome_banco);
        $sql->bindvalue(2,$tipo_conta);
        $sql->bindvalue(3,$agencia_conta);
        $sql->bindvalue(4,$numero_conta);
        $sql->bindvalue(5,$saldo_conta);
        $sql->bindvalue(6,UtilDAO::CodigoLogado());

        try{$sql->execute();
            return 1;

        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;

        }
       
    }
    public function AlterarConta($cod, $nome_banco, $tipo_conta, $agencia_conta, $numero_conta, $saldo_conta)
    {
        if (
            trim($nome_banco) == "" || trim($tipo_conta) == "" || trim($saldo_conta) == "" || trim($agencia_conta) == "" ||
            trim($numero_conta) == ""
        ) {
            return 0;
        }
    $conexao = parent::retornarConexao();
        $comando_sql = 'update tb_conta set nome_banco = ?, tipo_conta = ?, agencia_conta = ?, numero_conta = ?, saldo_conta =?
                        where id_conta = ? and id_usuario = ?';
        $sal = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome_banco);
        $sql->bindValue(2, $tipo_conta);
        $sql->bindValue(3, $agencia_conta);
        $sql->bindValue(3, $numero_conta);
        $sql->bindValue(3, $saldo_conta);
        $sql->bindValue(4,$cod);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;

        }catch(Exception $ex ){
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirConta($cod){
        if($cod == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'delete from tb_conta where id_conta =? and id_usuario =?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $cod);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try{$sql->execute();
            return 1;

        }catch(Exception $ex ){
           
            return -2;
        }

    }
}
