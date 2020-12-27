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
	private SituacaoLivro situacao = SituacaoLivro.DISPONIVEL;
	
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

	public void setCodBarras(Long codBarras) {
		this.codBarras = codBarras;
	}

	public void setPatrimonio(Long patrimonio) {
		this.patrimonio = patrimonio;
	}

	public void setLocalizacao(String localizacao) {
		this.localizacao = localizacao;
	}

	public void setTitulo(String titulo) {
		this.titulo = titulo;
	}

	public void setAutor(String autor) {
		this.autor = autor;
	}

	public void setEdicao(String edicao) {
		this.edicao = edicao;
	}

	public void setAno(String ano) {
		this.ano = ano;
	}

	public void setVolume(String volume) {
		this.volume = volume;
	}

	public void setSituacao(SituacaoLivro situacao) {
		this.situacao = situacao;
	}

	public void setDataQuarentena(LocalDate dataQuarentena) {
		this.dataQuarentena = dataQuarentena;
	}	
}
