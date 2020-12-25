package br.com.sisbib.api.modelo.controller.form;

import java.time.LocalDate;

import javax.validation.constraints.NotEmpty;
import javax.validation.constraints.NotNull;

import org.hibernate.validator.constraints.Length;

import br.com.sisbib.api.modelo.Livro;
import br.com.sisbib.api.modelo.SituacaoLivro;

public class LivroForm {
	@NotNull
	private Long codBarras;
	private Long patrimonio;
	private String localizacao;
	@NotNull @NotEmpty @Length(min = 5)
	private String titulo;
	@NotNull @NotEmpty @Length(min = 5)
	private String autor;
	private String edicao;
	private String ano;
	private String volume;
	private SituacaoLivro situacao;
	private LocalDate dataQuarentena;
	
	public Long getCodBarras() {
		return codBarras;
	}
	public void setCodBarras(Long codBarras) {
		this.codBarras = codBarras;
	}
	public Long getPatrimonio() {
		return patrimonio;
	}
	public void setPatrimonio(Long patrimonio) {
		this.patrimonio = patrimonio;
	}
	public String getLocalizacao() {
		return localizacao;
	}
	public void setLocalizacao(String localizacao) {
		this.localizacao = localizacao;
	}
	public String getTitulo() {
		return titulo;
	}
	public void setTitulo(String titulo) {
		this.titulo = titulo;
	}
	public String getAutor() {
		return autor;
	}
	public void setAutor(String autor) {
		this.autor = autor;
	}
	public String getEdicao() {
		return edicao;
	}
	public void setEdicao(String edicao) {
		this.edicao = edicao;
	}
	public String getAno() {
		return ano;
	}
	public void setAno(String ano) {
		this.ano = ano;
	}
	public String getVolume() {
		return volume;
	}
	public void setVolume(String volume) {
		this.volume = volume;
	}
	public SituacaoLivro getSituacao() {
		return situacao;
	}
	public void setSituacao(SituacaoLivro situacao) {
		this.situacao = situacao;
	}
	public LocalDate getDataQuarentena() {
		return dataQuarentena;
	}
	public void setDataQuarentena(LocalDate dataQuarentena) {
		this.dataQuarentena = dataQuarentena;
	}
	
	public Livro converter() {
		return new Livro(codBarras, patrimonio, localizacao, titulo, autor, edicao, ano, volume, situacao, dataQuarentena);
	}
}
