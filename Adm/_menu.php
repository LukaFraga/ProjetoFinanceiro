<?php
require_once '../dao/UTILdao.php';
if(isset($_GET['close']) && $_GET['close'] == '1'){
    UtilDAO::Deslogar();
}
?>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">



            <li>
                <a href="meus_dados.php"><i class="fa fa-dashboard fa-3x"></i> Meus Dados</a>
            </li>
            <li>
                <a href="Conta.php"><i class="fa fa-desktop fa-3x"></i> Conta</a>
            </li>
            <li>
                <a href="Empresa.php"><i class="fa fa-qrcode fa-3x"></i> Empresa</a>
            </li>
            <li>
                <a href="Categoria.php"><i class="fa fa-bar-chart-o fa-3x"></i> Categoria</a>
            </li>
            <li>
                <a href="movimento.php"><i class="fa fa-table fa-3x"></i> Movimento</a>
            </li>



            <li>
                <a href="_menu.php?close=1"><i class="fa fa-square-o fa-3x"></i> Sair</a>
            </li>
        </ul>

    </div>

</nav>