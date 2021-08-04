<?php
include_once '_head.php';

require_once '../dao/MovimentoDao.php';
require_once '../dao/EmpresaDao.php';
require_once '../dao/ContaDao.php';
require_once '../dao/CategoriaDao.php';

$dao_emp = new EmpresaDAO();
$dao_conts = new ContaDao();
$dao_cat = new CategoriaDao();

$tipo_filtro = '-1';

$dt_inicial = '';
$dt_final = '';

if (isset($_POST['btnSalvar'])) {
    $tipo_movimento = $_POST['tipo_movimento'];
    $data = $_POST['data'];
    $categoria = $_POST['categoria'];
    $conta = $_POST['conta'];
    $empresa = $_POST['empresa'];
    $valor = $_POST['valor'];
    $observacao = $_POST['observacao'];

    $dao = new MovimentoDAO;
    $ret = $dao->CadastrarMovimento($tipo_movimento, $data, $categoria, $conta, $empresa, $valor, $observacao);
} else if (isset($_POST['btnPesquisar'])) {

    $tipo_filtro = $_POST['tipo_filtro'];
    $dt_inicial = $_POST['dtincial'];
    $dt_final = $_POST['dtfinal'];

    $dao = new MovimentoDAO;
    $mov = $dao->PesquisarMovimento($tipo_filtro, $dt_inicial, $dt_final);
}else if(isset($_GET['codExc']) && is_numeric($_GET['codExc'])){
    $dao = new MovimentoDAO;
    $ret = $dao->ExcluirMovimento($_GET['codExc']);
}

$emp = $dao_emp->ConsultarEmpresa();
$conts = $dao_conts->ConsultarConta();
$cats = $dao_cat->ConsultarCategoria();

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
                        <h2>Movimento</h2>
                        <h5>Gerencie o seu histórico de Movimento </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form method="post" action="movimento.php">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Tipo do Movimento</label>
                            <select class="form-control" name="tipo_movimento" id="movimento">
                                <option value="">Escolha seu tipo de Movimento</option>
                                <option value="0">Entrada</option>
                                <option value="1">Saída</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control" name="categoria" id="categoria">
                                <option value="">Escolha seu tipo de Categoria</option>
                                <?php foreach ($cats as $item) { ?>
                                    <option value="<?= $item['id_categoria'] ?>"><?= $item['nome_categoria'] ?></option>
                                <?php } ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Empresa</label>
                            <select class="form-control" name="empresa" id="empresa">
                                <option value="">Escolha a sua Empresa </option>
                                <?php for ($i = 0; $i < count($emp); $i++) { ?>
                                    <option value="<?= $emp[$i]["id_empresa"] ?>"><?= $emp[$i]["nome_empresa"] ?></option>


                                <?php } ?>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Data</label>
                            <input class="form-control" type="date" name="data" id="data">
                        </div>

                        <div class="form-group">
                            <label>Conta</label>
                            <select class="form-control" name="conta" id="conta">
                                <option value="">Escolha sua conta</option>
                                <?php for ($i = 0; $i < count($conts); $i++) { ?>
                                    <option value="<?= $conts[$i]["id_conta"] ?>"><?= $conts[$i]["banco_conta"] ?> conta: <?= $conts[$i]["agencia_conta"] ?> <?= $conts[$i]["numero_conta"] ?> / saldo: <?= $conts[$i]["saldo_conta"] ?>
                                    <option>
                                    <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Valor</label>
                            <input class="form-control" placeholder="Digite aqui" name="valor" id="valor" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observação</label>
                            <textarea class="form-control" placeholder="Digite aqui" name="observacao"></textarea>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarCamposMovimento()">Cadastrar</button>
                        <button type="submit" class="btn btn-warning" name="btnAlterar">Alterar</button>
                    </center>
                </form>
                <hr>
                <form method="post" action="movimento.php">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo do Movimento</label>
                            <select class="form-control" name="tipo_filtro" id="tipomov">
                                <option value="2" <?= $tipo_filtro == 2 ? 'selected' : '' ?>>TODOS</option>
                                <option value="0" <?= $tipo_filtro == 0 ? 'selected' : '' ?>>Entrada</option>
                                <option value="1" <?= $tipo_filtro == 1 ? 'selected' : '' ?>>Saída</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Inicial</label>
                            <input class="form-control" type="date" name="dtincial" id="dtinicial" value="<?= $dt_inicial ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Final</label>
                            <input class="form-control" type="date" name="dtfinal" id="dtfinal" value="<?= $dt_final ?>">
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-info" name="btnPesquisar" onclick="return ValidarCamposPesquisa()">Pesquisar</button>
                        <hr>
                    </center>
                </form>
                <?php if (isset($mov)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!--   Kitchen Sink -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Filtra Movimentos
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Tipo</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Data</th>
                                                    <th>Conta</th>
                                                    <th>Valor</th>
                                                    <th>Observação</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i = 0; $i < count($mov); $i++) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $mov[$i]['tipo_movimento'] == 0 ?'Entrada' : 'Saída' ?></td>
                                                    <td><?= $mov[$i]['nome_categoria']?></td>
                                                    <td><?= $mov[$i]['nome_empresa']?></td>
                                                    <td><?= $mov[$i]['data_movimento']?></td>
                                                    <td><?= $mov[$i]['agencia_conta'] . ' - ' . $mov[$i]['numero_conta'] .  '('.$mov[$i]['banco_conta'] . ')' ?></td>
                                                    <td><?= $mov[$i]['valor_movimento']?></td>
                                                    <td><?= $mov[$i]['obs_movimento']?></td>                                                 
                                                    <td>
                                                        <a href="movimento.php?codExc=<?= $mov[$i]['id_movimento'] ?>" class="btn btn-danger btn-xs">Excluir</a>

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
                <?php } ?>
            </div>

        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->

</body>

</html>