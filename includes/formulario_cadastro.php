<main>
	<div class="alert alert-light mt-5 col-7 mx-auto" role="alert">
		<h2 class="mt-3 text-secondary">Cadastro de Usúario</h2>
		<hr>
		<form method="post">
		    <div class="form-group">
		        <label>Insira sua matricula:</label>
		        <input type="text" class="form-control" name="matricula">
		    </div>
		    <div class="form-group">
		        <label>Seu Nome:</label>
		        <input type="text" class="form-control" name="nome" value="<?=$_SESSION['nome']?>" readonly>
		    </div>
		    <div class="form-group">
		        <label>Seu E-mail:</label>
		        <input type="text" class="form-control" name="email" value="<?=$_SESSION['email']?>" readonly>
		    </div>
		    <div class="form-group">
		        <label>Seu ID de Usúario:</label>
		        <input type="text" class="form-control" name="idUser" value="<?=$_SESSION['identifier']?>" readonly>
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
</main>