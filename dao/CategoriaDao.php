<?php

require_once 'Conexao.php';
require_once 'UTILdao.php';

class CategoriaDao extends Conexao
{

    public function ConsultarCategoria()
    {

        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_categoria, nome_categoria from tb_categoria where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());
        //Eliminar os indices das colunas
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return   $sql->fetchAll();
    }

    public function CadastrarCategoria($nome)
    {
        if (trim($nome) == "") {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'insert into tb_categoria (nome_categoria, id_usuario) values(?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::CodigoLogado());


        try {

            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getmessage();
            return -1;
        }
    }
      
    public function AlterarCategoria($cod, $nome){
        if (trim($nome) == "") {
            return 0;
    }
    $conexao = parent::retornarConexao();
        $comando_sql = 'update tb_categoria set nome_categoria =? where id_categoria = ? and id_usuario = ?';
        $sal = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2,$cod);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;

        }catch(Exception $ex ){
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirCategoria($cod){
        if($cod == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'delete from tb_Categoria where id_categoria =? and id_usuario =?';
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
