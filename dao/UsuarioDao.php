<?php

require_once 'Conexao.php';
require_once 'UTILdao.php';

class UsuarioDao extends Conexao
{
    public function AtualizarUsuario($nome, $email)
    {
        if (trim($nome) == "" || trim($email) == "") {
            return 0;
        }
        $conexao = parent::retornarConexao();
        $comando_sql = 'update tb_usuario set nome_usuario = ?, email_usuario = ? where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindvalue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try {
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }
    public function CadastrarUsuario($nome, $email, $senha, $rsenha)
    {
        if (trim($nome) == "" || trim($email) == "" || trim($senha) == '' || trim($rsenha) == '') {
            return 0;
        }

        if($rsenha != $senha){
            return 3;
        }


        $conexao = parent::retornarConexao();
        $comando_sql = 'insert into tb_usuario (nome_usuario, email_usuario, senha_usuario) values(?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindvalue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $senha);
        

        try {
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }
    public function ValidarLogin($email, $senha)
    {
        if (trim($email) == "" || trim($senha) == "") {
            return 0;
        }

        $conexao = parent::retornarConexao();


        $comando_sql = 'select id_usuario from tb_usuario where email_usuario = ? and senha_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);
        $sql->bindValue(2, $senha);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        $user = $sql->fetchAll();

        if (count($user) == 0) {
            return 2;
        } else {

            UtilDAO::CriarSessao($user[0]['id_usuario']);
            header('location: meus_dados.php');
            exit;
        }
    }



    public function ConsultarMeusDados()
    {

        $conexao = parent::retornarConexao();
        $comando_sql = 'select nome_usuario, email_usuario from tb_usuario where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }
}
