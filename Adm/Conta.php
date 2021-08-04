<?php

require_once '../dao/ContaDao.php';

$dao = new ContaDao();
$nome_banco = "";
$tipo_conta = "";
$agencia_conta = "";
$numero_conta = "";
$saldo_conta = "";
$cod = "";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $nome_banco = $_GET["nome_banco"];
    $tipo_conta = $_GET["tipo_conta"];
    $agencia_conta = $_GET["agencia_conta"];
    $numero_conta = $_GET["numero_conta"];
    $saldo_conta = $_GET["saldo_conta"];
    $cod = $_GET["id_conta"];
}

if (isset($_POST['btnSalvar'])) {
    $nome_banco = $_POST['nome_banco'];
    $tipo_conta = $_POST['tipo_conta'];
    $agencia_conta = $_POST['agencia'];
    $numero_conta = $_POST['numero_conta'];
    $saldo_conta = $_POST['saldo'];

    $dao = new ContaDao;

    if ($cod == '')
        $ret = $dao->CadastrarConta($nome_banco, $tipo_conta, $agencia_conta, $numero_conta, $saldo_conta);
    else
        $ret = $dao->AlterarConta($cod, $nome_banco, $tipo_conta, $agencia_conta, $numero_conta, $saldo_conta);

    $nome_banco = "";
    $tipo_conta = "";
    $agencia_conta = "";
    $numero_conta = "";
    $saldo_conta = "";
    $cod = "";
} else if (isset($_POST['btnExcluir'])) {
    $cod = $_POST['cod'];
    $ret = $dao->ExcluirConta($cod);
    $cod = '';
}

$conta = $dao->ConsultarConta();

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
                        <h2>Conta</h2>
                        <h5>Gerencie a sua conta </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method=post action="Conta.php">
                    <div class="form-group">
                        <label>Nome do banco</label>
                        <input class="form-control" name="nome_banco" placeholder="Digite aqui" id="nome" value="<?= $nome_banco ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Tipo da Conta</label>
                        <select class="form-control" name="tipo_conta" id="tipoconta">
                            <option value="">Escolha seu tipo de conta</option>
                            <option value="0">Conta Poupança</option>
                            <option value="1"> Conta Corrente</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Agência</label>
                        <input class="form-control" name="agencia" placeholder="Digite aqui" id="agencia" value="<?= $agencia_conta?>" />
                    </div>

                    <div class="form-group">
                        <label>Numero da Conta</label>
                        <input class="form-control" name="numero_conta" placeholder="Digite aqui" id="numero" value="<?= $numero_conta?>" />
                    </div>

                    <div class="form-group">
                        <label>Saldo</label>
                        <input class="form-control" name="saldo" placeholder="Digite aqui" id="saldo" value="<?= $saldo_conta?>" />
                    </div>

                    <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarCamposConta()"><?= $cod == '' ? 'Cadastrar' : 'Alterar' ?></button>
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
                                Contas Cadastradas
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome do banco</th>
                                                <th>Tipo</th>
                                                <th>Agencia</th>
                                                <th>Numero da conta</th>
                                                <th>Saldo</th>
                                                <th>Ação</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($conta); $i++) { ?></php>
                                                <tr class="odd gradeX">
                                                    <td><?= $conta[$i]['banco_conta'] ?></td>
                                                    <td><?= $conta[$i]['tipo_conta'] ?></td>
                                                    <td><?= $conta[$i]['agencia_conta'] ?></td>
                                                    <td><?= $conta[$i]['numero_conta'] ?></td>
                                                    <td><?= $conta[$i]['saldo_conta'] ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-xs">Modificar</a>

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