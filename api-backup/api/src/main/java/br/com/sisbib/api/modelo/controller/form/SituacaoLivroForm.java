package br.com.sisbib.api.modelo.controller.form;

import javax.validation.constraints.NotNull;

import br.com.sisbib.api.modelo.Livro;
import br.com.sisbib.api.modelo.SituacaoLivro;
import br.com.sisbib.api.modelo.repository.LivroRepository;

public class SituacaoLivroForm {
	@NotNull
	private SituacaoLivro situacao = SituacaoLivro.DISPONIVEL;
	
	public SituacaoLivro getSituacao() {
		return situacao;
	}
	public void setSituacao(SituacaoLivro situacao) {
		this.situacao = situacao;
	}
	
	public Livro atualizar(Long codBarras, LivroRepository livroRepository) {
		Livro livro = livroRepository.getOne(codBarras);
		
		livro.setSituacao(this.situacao);
		
		return livro;
	}
}
