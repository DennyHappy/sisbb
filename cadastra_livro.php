<?php
	$mensagem = '';
	if (isset($_GET['status'])) {
	    switch ($_GET['status']) {
	        case 'successCadastro':
	            $mensagem = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
	                            <strong>Livro cadastrado com sucesso!</strong>
	                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                            <span aria-hidden="true">&times;</span>
	                            </button>
	                        </div>';
	            break;
        }
    }

	$resultados = '';

	if (isset($_POST['codBarras'],$_POST['titulo'],$_POST['autor'],$_POST['edicao'],$_POST['localizacao'],$_POST['patrimonio'],$_POST['ano'],$_POST['volume'],$_POST['situacao'])) {
	    
	    $curl = curl_init();

	    curl_setopt_array($curl, array(
	      CURLOPT_URL => 'http://localhost:8080/livro',
	      CURLOPT_RETURNTRANSFER => true,
	      CURLOPT_ENCODING => '',
	      CURLOPT_MAXREDIRS => 10,
	      CURLOPT_TIMEOUT => 0,
	      CURLOPT_FOLLOWLOCATION => true,
	      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	      CURLOPT_CUSTOMREQUEST => 'POST',
	      CURLOPT_POSTFIELDS =>'{
	        "codBarras": "'.$_POST['codBarras'].'",
	        "titulo": "'.$_POST['titulo'].'",
	        "autor": "'.$_POST['autor'].'",
	        "edicao": "'.$_POST['edicao'].'",
	        "localizacao": "'.$_POST['localizacao'].'",
	        "patrimonio": "'.$_POST['patrimonio'].'",
	        "ano": "'.$_POST['ano'].'",
	        "volume": "'.$_POST['volume'].'",
	        "situacao": "'.$_POST['situacao'].'"
	    }',
	      CURLOPT_HTTPHEADER => array(
	        'Content-Type: application/json'
	      ),
	    ));

	    $response = curl_exec($curl);

	    curl_close($curl);
	    //$response2 = json_decode($response);

	    //echo "<pre>"; print_r($response2); echo "</pre>"; exit;

	    header('location: cadastra_livro.php?status=successCadastro');
	    exit;
	}

    if (isset($_POST['buscar_livro'])) {
    	$curl = curl_init();

    	curl_setopt_array($curl, array(
    	  CURLOPT_URL => 'http://localhost:8080/livro/?situacao=\'DISPONIVEL\'',
    	  CURLOPT_RETURNTRANSFER => true,
    	  CURLOPT_ENCODING => '',
    	  CURLOPT_MAXREDIRS => 10,
    	  CURLOPT_TIMEOUT => 0,
    	  CURLOPT_FOLLOWLOCATION => true,
    	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    	  CURLOPT_CUSTOMREQUEST => 'GET',
    	));

    	$response = curl_exec($curl);

    	curl_close($curl);

    	$livros = json_decode($response);

    	//echo "<pre>"; print_r($livros); echo "</pre>"; exit;

    	foreach ($livros as $livro) {
        $resultados .= '<tr>
        					<td class="text-center">'.$livro->codBarra.'</td>
        					<td class="text-center">'.$livro->patrimonio.'</td>
        					<td class="text-center">'.$livro->localizacao.'</td>
                            <td class="text-center">'.$livro->titulo.'</td>
                            <td class="text-center">'.$livro->autor.'</td>
                            <td class="text-center">'.$livro->edicao.'</td>
                            <td class="text-center">'.$livro->ano.'</td>
                            <td class="text-center">'.$livro->volume.'</td>
                            <td class="text-center">
                                <span class=" btn btn-secondary btn-sm">S/A</span>
                            </td>
                        </tr>';
        }
    }else{
        $resultados .= '
        				<td colspan="9" class="text-center">
	        				<div class="alert alert-warning" role="alert">
	                            <h5>Nenhum Livro Cadastrado!</h5>
	                        </div>
                        </td>';
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastra Livro via POST</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            .jumbotron {
                padding: 1rem 2rem;
            }
        </style>
    </head>
    <body class="bg-light font-weight-normal">
    	<div class="container">
    		<div class="alert alert-light mt-5 col-10 mx-auto" role="alert">
				<hr>
				<?=$mensagem?>
    			<ul class="nav nav-tabs" id="myTab" role="tablist">
    			  <li class="nav-item">
    			    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Cadastrar Livro</a>
    			  </li>
    			  <li class="nav-item">
    			    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Livros Cadastrados</a>
    			  </li>
    			</ul>

    			<div class="tab-content">
    			  <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
    			  	<h2 class="mt-3 text-secondary">Cadastro de Livro</h2>
    			  	<hr>
    			  	<form method="post">
    			  	    <div class="form-group">
    			  	        <label>Cod. Barras:</label>
    			  	        <input type="text" class="form-control" name="codBarras">
    			  	    </div>
    			  	    <div class="form-group">
    			  	        <label>Titulo:</label>
    			  	        <input type="text" class="form-control" name="titulo">
    			  	    </div>
    			  	    <div class="form-group">
    			  	        <label>Autor:</label>
    			  	        <input type="text" class="form-control" name="autor">
    			  	    </div>
    			  	    <div class="form-group">
    			  	        <label>Edição:</label>
    			  	        <input type="text" class="form-control" name="edicao">
    			  	    </div>
    			  	    <div class="form-group">
    			  	        <label>Localização:</label>
    			  	        <input type="text" class="form-control" name="localizacao">
    			  	    </div>
    			  	    <div class="form-group">
    			  	        <label>Patrimônio:</label>
    			  	        <input type="text" class="form-control" name="patrimonio">
    			  	    </div>
    			  	    <div class="form-group">
    			  	        <label>Ano:</label>
    			  	        <input type="text" class="form-control" name="ano">
    			  	    </div>
    			  	    <div class="form-group">
    			  	        <label>Volume:</label>
    			  	        <input type="text" class="form-control" name="volume">
    			  	    </div>
    			  	    <div class="form-group">
    			  	        <label>Situação:</label>
    			  	        <input type="text" class="form-control" name="situacao" value="DISPONIVEL" readonly>
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
    			  </div>
    			  <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    			  	<h2 class="mt-3 text-secondary">Livros Cadastrados</h2>
    			  	<hr>
    			  	<form method="post">
    			  		<button name="buscar_livro" type="submit" class="btn btn-success col-12">Listar Livros</button>
    			  	</form>
    			  	<section style="overflow-x: scroll; overflow-y: hidden; white-space: nowrap;">
    			  		
    			  	    <div>
    			  	        <table class="table table-hover bg-white mt-4">
    			  	            <thead>
    			  	                <tr>
    			  	                    <th class="text-center">COD. BARRAS</th>
    			  	                    <th class="text-center">PATRIÔNIO</th>
    			  	                    <th class="text-center">LOCALIZAÇÃO</th>
    			  	                    <th class="text-center">TITULO</th>
    			  	                    <th class="text-center">AUTOR</th>
    			  	                    <th class="text-center">EDIÇÃO</th>
    			  	                    <th class="text-center">ANO</th>
    			  	                    <th class="text-center">VOLUME</th>
    			  	                    <th class="text-center">AÇÕES</th>
    			  	                </tr>
    			  	            </thead>
    			  	            <tbody>
    			  	                <?=$resultados?>
    			  	            </tbody>
    			  	        </table>
    			  	    </div>
    			  	</section>
    			  </div>
    			</div>
	    	</div>
    	</div>

    	<script>
    	  $(function () {
    	    $('#myTab li:last-child a').tab('show')
    	  })
    	</script>
    	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>