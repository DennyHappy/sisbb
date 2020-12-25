package br.com.sisbib.api.modelo.controller.dto;

import java.util.List;
import java.util.stream.Collectors;

import br.com.sisbib.api.modelo.UsuarioBibliotecario;
import br.com.sisbib.api.modelo.UsuarioComum;

public class UsuarioBibliotecarioDto {
	private Long matricula;
	private String nome;
	private String email;
	private String senha;
	
	public UsuarioBibliotecarioDto(UsuarioBibliotecario usuario) {
		this.matricula = usuario.getMatricula();
		this.nome = usuario.getNome();
		this.email = usuario.getEmail();
		this.senha = usuario.getIdUser();
	}

	public static List<UsuarioBibliotecarioDto> converter(List<UsuarioBibliotecario> usuarios) {
		return usuarios.stream().map(UsuarioBibliotecarioDto::new).collect(Collectors.toList());
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
	
	public String getSenha() {
		return senha;
	}
}
