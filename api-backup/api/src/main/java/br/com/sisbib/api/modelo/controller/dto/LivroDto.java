package br.com.sisbib.api.modelo.controller.dto;

import java.util.List;
import java.util.stream.Collectors;

import br.com.sisbib.api.modelo.Livro;
import br.com.sisbib.api.modelo.SituacaoLivro;

public class LivroDto {
	private String titulo;
	private String autor;
	private String edicao;
	private String ano;
	private String volume;
	private SituacaoLivro situacao;
	
	public LivroDto(Livro livro) {
		this.titulo = livro.getTitulo();
		this.autor = livro.getAutor();
		this.edicao = livro.getEdicao();
		this.ano = livro.getAno();
		this.volume = livro.getVolume();
		this.situacao = livro.getSituacao();
	}

	public String getTitulo() {
		return titulo;
	}

	public String getAutor() {
		return autor;
	}

	public String getEdicao() {
		return edicao;
	}

	public String getAno() {
		return ano;
	}

	public String getVolume() {
		return volume;
	}

	public SituacaoLivro getSituacao() {
		return situacao;
	}
	
	public static List<LivroDto> converter(List<Livro> livros) {
		return livros.stream().map(LivroDto::new).collect(Collectors.toList());
	}
}
