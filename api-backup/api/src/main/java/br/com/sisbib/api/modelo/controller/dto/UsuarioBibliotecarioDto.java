package br.com.sisbib.api.modelo.controller.dto;

import org.springframework.data.domain.Page;

import br.com.sisbib.api.modelo.UsuarioBibliotecario;

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

	public static Page<UsuarioBibliotecarioDto> converter(Page<UsuarioBibliotecario> usuarios) {
		return usuarios.map(UsuarioBibliotecarioDto::new);
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
