<?php
if (isset($ret)) {
    switch ($ret) {
        case -1:
            echo '<div class= "alert alert-danger">
            Ocorreu um erro na operação ! tente mais tarde
            </div>';
            break;
        case -2:
            echo '<div class= "alert alert-danger">
                Não foi possivel Excluir o a empresa pois esta em uso.
                </div>';
            break;
        case 0:
            echo '<div class= "alert alert-warning">
            Preencher o(s) campo(s) obrigatório(s)
            </div>';
            break;
        case 1:
            echo '<div class= "alert alert-success">
               Ação realizada com sucesso.
                </div>';
            break;
        case 2:
            echo '<div class= "alert alert-warning">
                Usuário não encontrado
                </div>';
            break;
        case 3:
            echo '<div class= "alert alert-warning">
                Senha e repetir senha nao conferem
                </div>';
            break;
    }
}
