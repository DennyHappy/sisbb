package br.com.sisbib.api.modelo;

import javax.persistence.Entity;
import javax.persistence.Id;

@Entity
public class UsuarioComum {
	@Id
	private Long matricula;
	private String nome;
	private String email;
	private String idUser;
	
	public UsuarioComum() {
		
	}
	
	public UsuarioComum(Long matricula, String nome, String email, String idUser) {
		this.matricula = matricula;
		this.nome = nome;
		this.email = email;
		this.idUser = idUser;
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
		return idUser;
	}	
}
