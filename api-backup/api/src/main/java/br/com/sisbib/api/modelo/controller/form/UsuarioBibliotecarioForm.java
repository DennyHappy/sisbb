package br.com.sisbib.api.modelo.controller.form;

import javax.validation.constraints.NotEmpty;
import javax.validation.constraints.NotNull;

import br.com.sisbib.api.modelo.UsuarioBibliotecario;

public class UsuarioBibliotecarioForm {
	@NotNull
	private Long matricula;
	@NotNull @NotEmpty
	private String nome;
	@NotNull @NotEmpty
	private String email;
	@NotNull @NotEmpty
	private String senha;
	
	public UsuarioBibliotecario converter() {
		return new UsuarioBibliotecario(matricula, nome, email, senha);
	}

	public Long getMatricula() {
		return matricula;
	}

	public void setMatricula(Long matricula) {
		this.matricula = matricula;
	}

	public String getNome() {
		return nome;
	}

	public void setNome(String nome) {
		this.nome = nome;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getSenha() {
		return senha;
	}

	public void setSenha(String senha) {
		this.senha = senha;
	}
	
	
}
