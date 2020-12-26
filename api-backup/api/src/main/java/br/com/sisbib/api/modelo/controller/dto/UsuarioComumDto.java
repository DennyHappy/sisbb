package br.com.sisbib.api.modelo.controller.dto;

import org.springframework.data.domain.Page;

import br.com.sisbib.api.modelo.UsuarioComum;

public class UsuarioComumDto {
	private Long matricula;
	private String nome;
	private String email;
	private String idUser;
	
	public UsuarioComumDto(UsuarioComum usuario) {
		this.matricula = usuario.getMatricula();
		this.nome = usuario.getNome();
		this.email = usuario.getEmail();
		this.idUser = usuario.getIdUser();
	}

	public static Page<UsuarioComumDto> converter(Page<UsuarioComum> usuarios) {
		return usuarios.map(UsuarioComumDto::new);
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
