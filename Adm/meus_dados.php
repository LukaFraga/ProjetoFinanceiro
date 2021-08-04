<?php
include_once '../dao/UsuarioDao.php';

$dao = new UsuarioDao();

if (isset($_POST['btnSalvar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $dao = new UsuarioDao;
    $ret = $dao->AtualizarUsuario($nome, $email);
}

$Dados = $dao->ConsultarMeusDados();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php' ?>
                        <h2>Meus Dados</h2>
                        <h5>Gerencie os seus Dados </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method=post action="meus_dados.php">
                    <div class="form-group">
                        <label>Seu Nome</label>
                    <input class="form-control" name="nome" placeholder="Digite aqui" id="nome" value="<?= $Dados[0]['nome_usuario'] ?>"/>
                    </div>  

                    <div class="form-group">
                        <label>Seu E-mail</label>
                        <input class="form-control" name="email" placeholder="Digite aqui"  id="email" value="<?= $Dados[0]['email_usuario'] ?>"/>
                    </div>


                    <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarCamposMeusDados()">Gravar</button>
                </form>



</body>

</html>