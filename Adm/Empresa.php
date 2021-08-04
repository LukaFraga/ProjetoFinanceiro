<?php
require_once '../dao/EmpresaDao.php';
$dao = new EmpresaDAO();
$cod = '';
$nome = '';
$endereco = '';
$telefone = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $cod = $_GET['id'];
    $nome = $_GET['nome'];
    $endereco = $_GET['endereco'];
    $telefone = $_GET['telefone'];
}

if (isset($_POST['btnSalvar'])) {
    $endereco = $_POST['endereco_empresa'];
    $telefone = $_POST['telefone_empresa'];
    $nome = $_POST['nome'];
    $cod = $_POST['cod'];
    

    if ($cod == '')
        $ret = $dao->CadastrarEmpresa($nome, $endereco, $telefone);
    else
        $ret = $dao->AlterarEmpresa($cod, $nome, $endereco, $telefone);

    $cod = '';
    $nome = '';
    $endereco = '';
    $telefone = '';


} else if (isset($_POST['btnExcluir'])) {
    $cod = $_POST['cod'];
    $ret = $dao->ExcluirEmpresa($cod);
    $cod = '';
}


$empresa = $dao->ConsultarEmpresa();

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
                        <h2>Empresa</h2>
                        <h5>Gerencie o seu cadastro de empresa </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method='post' action="Empresa.php">
                    <input type="hidden" name="cod" value="<?= $cod ?>">
                    <div class="form-group">
                        <label>Nome da Empresa</label>
                        <input class="form-control" name="nome" placeholder="Digite aqui" id="nome" value="<?= $nome ?>" />
                    </div>

                    <div class="form-group">
                        <label>Endereço</label>
                        <input class="form-control" name="endereco_empresa" placeholder="Digite aqui" id="endereco" value="<?= $endereco?>"/>
                    </div>

                    <div class="form-group">
                        <label>Telefone </label>
                        <input class="form-control" name="telefone_empresa" placeholder="Digite aqui" id="telefone" value="<?= $telefone?>" />
                    </div>

                    <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarCamposEmpresa()"><?= $cod == '' ? 'Cadastrar' : 'Alterar' ?></button>
                    <?php if ($cod != '') { ?>
                        <button type="submit" class="btn btn-warning">Cancelar</button>
                        <button type="submit" class="btn btn-danger" name="btnExcluir">Excluir</button>
                    <?php } ?>
                    <hr>
                </form>

                <div class="row">
                    <div class="col-md-12">
                        <!--   Kitchen Sink -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Empresas Cadastradas
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome da Empresa</th>
                                                <th>Endereço</th>
                                                <th>Telefone</th>
                                                <th>Ação</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($empresa); $i++) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $empresa[$i]['nome_empresa'] ?></td>
                                                    <td><?= $empresa[$i]['endereco_empresa'] ?></td>
                                                    <td><?= $empresa[$i]['telefone_empresa'] ?></td>
                                                    <td>
                                                        <a href="empresa.php?id=<?= $empresa[$i]['id_empresa'] ?>&nome=<?= $empresa[$i]['nome_empresa'] ?>&endereco=<?= $empresa[$i]['endereco_empresa'] ?>&telefone=<?= $empresa[$i]['telefone_empresa'] ?>" class="btn btn-info btn-xs">Modificar</a>

                                                    </td>


                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->

</body>

</html>