package br.com.sisbib.api.modelo.controller.dto;

import java.util.List;
import java.util.stream.Collectors;

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

	public static List<UsuarioComumDto> converter(List<UsuarioComum> usuarios) {
		return usuarios.stream().map(UsuarioComumDto::new).collect(Collectors.toList());
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
