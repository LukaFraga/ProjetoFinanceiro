<?php


require_once '../dao/CategoriaDao.php';
$dao = new CategoriaDao();
$cod = '';
$nome = '';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $cod = $_GET['id'];
    $nome = $_GET['nome'];
}

if (isset($_POST['btnSalvar'])) {
    $nome = $_POST['nome'];
    $cod = $_POST['cod'];
   
    $ret = $dao->CadastrarCategoria($nome);


if ($cod == '')
$ret = $dao->CadastrarCategoria($nome);
else
$ret = $dao->AlterarCategoria($cod, $nome);

$cod = '';
$nome = '';

} else if (isset($_POST['btnExcluir'])) {
    $cod = $_POST['cod'];
    $ret = $dao->ExcluirCategoria($cod);
    $cod = '';
}

$categorias = $dao->ConsultarCategoria();
// echo '<pre>';
// print_r($categorias);
// echo '</pre>';
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
                        <h2>Categoria</h2>
                        <h5>Gerencie a sua categoria </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method="post" action="Categoria.php">
                    <input type="hidden" name="cod" value="<?= $cod ?>">
                    <div class="form-group">
                        <label>Nome da Categoria</label>
                        <input name="nome" class="form-control" placeholder="Digite aqui" id="nome" value="<?= $nome ?>"/>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarCamposCategoria()"><?= $cod == '' ? 'Cadastrar' : 'Alterar'?></button>
                    <?php if($cod != '') { ?>
                    <button type="submit" class="btn btn-warning" name="btnCancelar">Cancelar</button>
                    <button type="submit" class="btn btn-danger" name="btnExcluir">Excluir</button>
                    <?php } ?>
                    <hr>
                </form>

                <div class="row">
                    <div class="col-md-12">
                        <!--   Kitchen Sink -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Categorias Cadastradas
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome da Categoria</th>
                                                <th>Ação</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for($i=0; $i < count($categorias); $i++){ ?>
                                            <tr class="odd gradeX">
                                                <td><?= $categorias[$i]['nome_categoria'] ?></td>
                                                <td>
                                                <a href="categoria.php?id=<?= $categorias[$i]['id_categoria'] ?>&nome=<?= $categorias[$i]['nome_categoria'] ?>" class="btn btn-info btn-xs">Modificar</a>

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