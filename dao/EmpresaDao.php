<?php
require_once 'Conexao.php';
require_once 'UTILdao.php';

class EmpresaDAO extends Conexao 
{
    public function CadastrarEmpresa($nome_empresa, $endereco, $telefone)
    {
        if (trim($nome_empresa) == "" || trim($endereco) == "" || trim($telefone) == "") {
            return 0;
        }
        $conexao = parent::retornarConexao();
        $comando_sql = 'insert into tb_empresa(nome_empresa, endereco_empresa, telefone_empresa,id_usuario) values(?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1,$nome_empresa);
        $sql->bindValue(2,$endereco);
        $sql->bindValue(3,$telefone);
        $sql->bindValue(4,UtilDAO::CodigoLogado());

        try{$sql->execute();
            return 1;

        }catch(Exception $ex ){
            echo $ex->getMessage();
            return -1;
        }

        
    }

    public function AlterarEmpresa($cod, $nome_empresa, $endereco, $telefone){
        if (trim($nome_empresa) == "" || trim($endereco) == "" || trim($telefone) == "") {
            return 0;
    }
    $conexao = parent::retornarConexao();
        $comando_sql = 'update tb_empresa set nome_empresa =?, endereco_empresa = ?, telefone_empresa = ?
                        where id_empresa = ? and id_usuario = ?';
        $sal = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome_empresa);
        $sql->bindValue(2, $endereco);
        $sql->bindValue(3, $telefone);
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

    public function ExcluirEmpresa($cod){
        if($cod == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'delete from tb_empresa where id_empresa =? and id_usuario =?';
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



    public function ConsultarEmpresa(){
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_empresa, nome_empresa, endereco_empresa, telefone_empresa 
                        from tb_empresa where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1,UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchALL();

    }
}
