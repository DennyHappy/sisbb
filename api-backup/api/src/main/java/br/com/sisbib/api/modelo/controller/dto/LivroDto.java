package br.com.sisbib.api.modelo.controller.dto;

import java.time.LocalDate;

import org.springframework.data.domain.Page;

import br.com.sisbib.api.modelo.Livro;
import br.com.sisbib.api.modelo.SituacaoLivro;

public class LivroDto {
	private String titulo;
	private String autor;
	private String edicao;
	private String ano;
	private String volume;
	private SituacaoLivro situacao;
	private Long codBarras;
	private Long patrimonio;
	private String localizacao;
	private LocalDate dataQuarentena;
	
	public LivroDto(Livro livro) {
		this.titulo = livro.getTitulo();
		this.autor = livro.getAutor();
		this.edicao = livro.getEdicao();
		this.ano = livro.getAno();
		this.volume = livro.getVolume();
		this.situacao = livro.getSituacao();
		this.codBarras = livro.getCodBarras();
		this.patrimonio = livro.getPatrimonio();
		this.localizacao = livro.getLocalizacao();
		this.dataQuarentena = livro.getDataQuarentena();
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
	
	public Long getCodBarras() {
		return codBarras;
	}
	
	public String getLocalizacao() {
		return localizacao;
	}
	
	public Long getPatrimonio() {
		return patrimonio;
	}
	
	public LocalDate getDataQuarentena() {
		return dataQuarentena;
	}
	
	public static Page<LivroDto> converter(Page<Livro> livros) {
		return livros.map(LivroDto::new);
	}
}
