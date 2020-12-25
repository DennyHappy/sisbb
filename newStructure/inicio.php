<?php
require_once 'config.php';

try {
    //DEFINIÇÃOES DA API DE AUTENTICAÇÃO DO GOOGLE
    $adapter->authenticate();
    $userProfile = $adapter->getUserProfile();

    $_SESSION['nome'] = $userProfile->displayName;
    $_SESSION['email'] = $userProfile->email;
    $_SESSION['identifier'] = $userProfile->identifier;

    //CRIAÇÃO DO JSON PARA VERIFICAÇÃO DO LOGIN

    if (isset($_SESSION['nome'],$_SESSION['email'],$_SESSION['identifier'])) {
        $user =    [
                        'nome' => $_SESSION['nome'],
                        'email' => $_SESSION['email'],
                        'idUser' => $_SESSION['identifier']
                    ];

        $result = json_encode($user);
    }
    
    echo '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Área de Login</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
                <style>
                    .jumbotron {
                        padding: 1rem 2rem;
                    }
                </style>
            </head>
            <body class="bg-light font-weight-normal">
                <div class="container">
                    <div class="jumbotron bg-success text-light">
                        <h1>SISBAEL - IFRN_NC
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-book-half" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8.5 2.687v9.746c.935-.53 2.12-.603 3.213-.493 1.18.12 2.37.461 3.287.811V2.828c-.885-.37-2.154-.769-3.388-.893-1.33-.134-2.458.063-3.112.752zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                        </svg>
                        </h1>
                        <p>Sistema de Biblioteca para Agendamento de Empréstimos de Livros</p>
                        <hr class="my-4">
                    </div>
                    <div class="alert alert-light mt-5 col-7 mx-auto" role="alert">';
    
    //FAZ A REQUISIÇÃO DE BUSCA NO BANCO COM O JSON $result SE O USUARIO É ALUNO E ESTÁ NO BANCO
    //
    //
    //
    //
    //
    //
    //

    //SE O RESULTADO DA BUSCA RETORNAR ALGO
    if (TRUE)) {

        //ARMAZENA O PARAMETRO matricula DO RESULTADO DA BUSCA NUMA VARIAVEL DE SESSÃO
        $_SESSION['matricula'] = '';

        //VERIFICA SE PARAMETRO email DO RESULTADO DA BUSCA É IGUAL A VARIAVEL DE SESSÃO email
        //E SE O email DO RESULTADO DA BUSCA TEM A TERMINAÇÃO '@escolar.ifrn.edu.br' COM strpos(email, '@escolar.ifrn.edu.br')
        if (TRUE){

            //APRESENTA A TELA DE LOGIN IMPRIMINDO OS DADOS DO USUARIO E DIRECIONA PARA DEVIDA DASHBOARD
            echo '
                <h5 class="mt-3 text-secondary text-center">Conta Encontrada - Aluno</h5>
                <hr>
                <div class="form-group">
                    <label>Seu Nome:</label>
                    <input type="text" class="form-control" name="userC_nome" value="'.$_SESSION['nome'].'" readonly>
                </div>
                <div class="form-group">
                    <label>Seu E-mail:</label>
                    <input type="text" class="form-control" name="userC_email" value="'.$_SESSION['email'].'" readonly>
                </div>
                <div class="form-group">
                    <a href="sisbbAluno/" class="btn btn-success col-12">
                        Entrar
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right-square-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.879 10.828a.5.5 0 1 1-.707-.707l4.096-4.096H6.5a.5.5 0 0 1 0-1h3.975a.5.5 0 0 1 .5.5V9.5a.5.5 0 0 1-1 0V6.732l-4.096 4.096z"/>
                        </svg>
                    </a>
                </div>
            ';
        }
        
    }else{

        //SE O RESULTADO DA BUSCA RETORNAR NADA
        //E A VARIAVEL DE SESSÃO email TERMINAR COM '@escolar.ifrn.edu.br' COM strpos($_SESSION['email'], '@escolar.ifrn.edu.br')
        if (TRUE) {

            //APRESENTA A TELA DE LOGIN IMPRIMINDO OS DADOS DO USUARIO E EFETUA O CADASTRO DO NOVO USUARIO
            echo '
                <h2 class="mt-3 text-secondary">Cadastro de Usúario</h2>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label>Insira sua matricula:</label>
                        <input type="text" class="form-control" name="matricula">
                    </div>
                    <div class="form-group">
                        <label>Seu Nome:</label>
                        <input type="text" class="form-control" name="nome" value="'.$_SESSION['nome'].'" readonly>
                    </div>
                    <div class="form-group">
                        <label>Seu E-mail:</label>
                        <input type="text" class="form-control" name="email" value="'.$_SESSION['email'].'" readonly>
                    </div>
                    <div class="form-group">
                        <label>Seu ID de Usúario:</label>
                        <input type="text" class="form-control" name="idUser" value="'.$_SESSION['identifier'].'" readonly>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success col-12">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                            Cadastrar
                        </button>
                    </div>
                </form>
            ';

            //CADASTRA NOVO USUARIO E DIRECIONA PARA DEVIDA DASHBOARD
            if (isset($_POST['matricula'],$_POST['nome'],$_POST['email'],$_POST['idUser'])) {
                $newUser =    [
                                'matricula' => $_SESSION['matricula'],
                                'nome' => $_SESSION['nome'],
                                'email' => $_SESSION['email'],
                                'idUser' => $_SESSION['identifier']
                            ];

                $result = json_encode($newUser);
            
                header('location: sisbbAluno/index.php?status=successCadastroUser');
                exit;
            }

        //SE O RESULTADO DA BUSCA RETORNAR NADA
        //E A VARIAVEL DE SESSÃO email TERMINAR NÃO TERMINAR COM '@escolar.ifrn.edu.br' COM strpos($_SESSION['email'], '@escolar.ifrn.edu.br')
        }elseif (TRUE) {
            //A CONTA GOOGLE É DESCONECTADA
            $adapter->disconnect();

            //A SESSÃO INICIADA É LIMPA E DEPOIS DESTRUIDA
            session_unset();
            session_destroy();

            header('location: index.php?status=errorLogin');
            exit;
        }
    }
        echo '
                </div>
            </div>
        </body>
    </html>';
}
catch( Exception $e ){
    echo $e->getMessage() ;
}
