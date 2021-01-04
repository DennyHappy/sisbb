package br.com.sisbib.api.modelo.controller.form;

import java.time.LocalDate;

import javax.validation.constraints.NotNull;

import br.com.sisbib.api.modelo.Livro;
import br.com.sisbib.api.modelo.SituacaoLivro;
import br.com.sisbib.api.modelo.repository.LivroRepository;

public class AtualizaLivroForm {
	@NotNull
	private SituacaoLivro situacao = SituacaoLivro.DISPONIVEL;
	private LocalDate dataQuarentena;
	
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
	
	public Livro atualizar(Long codBarras, LivroRepository livroRepository) {
		Livro livro = livroRepository.getOne(codBarras);
		
		livro.setSituacao(this.situacao);
		livro.setDataQuarentena(this.dataQuarentena);
		
		return livro;
	}
}
