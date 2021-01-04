package br.com.sisbib.api.modelo.controller.dto;

import java.util.List;

import org.springframework.data.domain.Page;

import br.com.sisbib.api.modelo.Perfil;
import br.com.sisbib.api.modelo.Usuario;

public class UsuarioDto {
	private Long matricula;
	private String nome;
	private String email;
	private String idUser;
	List<Perfil> perfis;
	
	public UsuarioDto(Usuario usuario) {
		this.matricula = usuario.getMatricula();
		this.nome = usuario.getNome();
		this.email = usuario.getEmail();
		this.idUser = usuario.getIdUser();
		this.perfis = usuario.getPerfis();
	}

	public static Page<UsuarioDto> converter(Page<Usuario> usuarios) {
		return usuarios.map(UsuarioDto::new);
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
	
	public List<Perfil> getPerfis() {
		return perfis;
	}
}
