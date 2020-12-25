<?php 

	if (isset($_POST['codBarras'],$_POST['titulo'],$_POST['autor'],$_POST['edicao'],$_POST['ano'],$_POST['volume'],$_POST['situacao'])) {
	    $livro = 	[
	    				'codBarras' => $_POST['codBarras'],
	    				'titulo' => $_POST['titulo'],
	    				'autor' => $_POST['autor'],
	    				'edicao' => $_POST['edicao'],
	    				'ano' => $_POST['ano'],
	    				'volume' => $_POST['volume'],
	    				'situacao' => $_POST['situacao']
				    ];

		$result = json_encode($livro);
		echo "<pre>"; print_r($result); echo "</pre>"; exit;
	    
	    exit;
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
    		<div class="alert alert-light mt-5 col-7 mx-auto" role="alert">
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
		    	        <label>Ano:</label>
		    	        <input type="text" class="form-control" name="ano">
		    	    </div>
		    	    <div class="form-group">
		    	        <label>Volume:</label>
		    	        <input type="text" class="form-control" name="volume">
		    	    </div>
		    	    <div class="form-group">
		    	        <label>Situação:</label>
		    	        <input type="text" class="form-control" name="situacao" value="disponivel" readonly>
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
    	</div>
    </body>
</html>