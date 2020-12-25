package br.com.sisbib.api.modelo;

import javax.persistence.Entity;
import javax.persistence.Id;

@Entity
public class UsuarioBibliotecario {
	@Id
	private Long matricula;
	private String nome;
	private String email;
	private String senha;
	
	public UsuarioBibliotecario() {
		
	}
	
	public UsuarioBibliotecario(Long matricula, String nome, String email, String senha) {
		this.matricula = matricula;
		this.nome = nome;
		this.email = email;
		this.senha = senha;
	}

	public Long getMatricula() {
		return matricula;
	}

	public String getNome() {
		return nome;
	}

	public String getEmail() {
		return email;
	}

	public String getIdUser() {
		return senha;
	}	
}
