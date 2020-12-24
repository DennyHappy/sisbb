package br.com.sisbib.api.modelo;

import java.time.LocalDate;

import javax.persistence.Entity;
import javax.persistence.EnumType;
import javax.persistence.Enumerated;
import javax.persistence.Id;

@Entity
public class Livro {
	@Id
	private Long codBarras;
	private Long patrimonio;
	private String localizacao;
	private String titulo;
	private String autor;
	private String edicao;
	private String ano;
	private String volume;
	
	@Enumerated(EnumType.STRING)
	private SituacaoLivro situacao;
	
	private LocalDate dataQuarentena;
	
	public Livro() {
		
	}

	public Livro(Long codBarras, Long patrimonio, String localizacao, String titulo, String autor, String edicao,
			String ano, String volume, SituacaoLivro situacao, LocalDate dataQuarentena) {
		this.codBarras = codBarras;
		this.patrimonio = patrimonio;
		this.localizacao = localizacao;
		this.titulo = titulo;
		this.autor = autor;
		this.edicao = edicao;
		this.ano = ano;
		this.volume = volume;
		this.situacao = situacao;
		this.dataQuarentena = dataQuarentena;
	}

	public Long getCodBarras() {
		return codBarras;
	}

	public Long getPatrimonio() {
		return patrimonio;
	}

	public String getLocalizacao() {
		return localizacao;
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

	public LocalDate getDataQuarentena() {
		return dataQuarentena;
	}
}
