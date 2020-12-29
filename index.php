<style type="text/css">
    @media(max-width: 400px){
        h5{
            font-size: 3px;
        }
        
    }
</style>
<?php

    $mensagem = '';
    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'errorAcesso':
                $mensagem = '<div class="alert alert-warning text-center" role="alert">
                                <h5>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                                    </svg><br>
                                    Você precisa fazer login para continuar</h5>
                            </div>';
                break;
            case 'successLogout':
                $mensagem = '<div class="alert alert-info text-center" role="alert">
                                <h5>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                    </svg><br>
                                    Usuário desconectado!</h5>
                            </div>';
                break;
            case 'errorLogin':
                $mensagem = '<div class="alert alert-danger text-center" role="alert">
                                <h5>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16">
                                      <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                                      <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg><br>
                                    Usuário incompatível, entre com uma conta escolar do Google!</h5>
                            </div>';
                break;
            case 'errorCadastroExistente':
                $mensagem = '<div class="alert alert-info text-center" role="alert">
                                <h5>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                    </svg><br>
                                    Usuário já cadastrado!<br>Faça login para continuar!</h5>
                            </div>';
                break;
            case 'errorCadastroNaoEncontrado':
                $mensagem = '<div class="alert alert-info text-center" role="alert">
                                <h5>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                    </svg><br>
                                    Usuário inexistente!</h5>
                            </div>';
                break;
        }
    }

include __DIR__.'/includes/header2.php';

echo '<main>
            '.$mensagem.'
            <div class="alert alert-light mt-5 text-center col-6 mx-auto tm" role="alert">
                <h5>Entrar como:</h5>
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active col-6" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Aluno</a>
                    <a class="nav-item nav-link col-6" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Bibliotecário</a>
                    
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row mt-3">
                        <div class="col-6">
                            <p><a href="fazerLogin.php" class="btn btn-success btn-lg col-12">
                                Fazer Login
                            </a></p>
                        </div>
                        <div class="col-6">
                            <p><a href="sisbbAluno/verificaUser.php" class="btn btn-success btn-lg col-12">
                                Cadastrar-se
                            </a></p>
                        </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                  
                </div>
                
                
            </div>
        
    </main>';
include __DIR__.'/includes/footer.php';
?>