package br.com.sisbib.api.modelo.repository;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;

import br.com.sisbib.api.modelo.Livro;
import br.com.sisbib.api.modelo.SituacaoLivro;

public interface LivroRepository extends JpaRepository<Livro, Long>{
	Page<Livro> findByTituloIgnoreCaseContaining(String titulo, Pageable paginacao);

	Page<Livro> findByAutorIgnoreCaseContaining(String autor, Pageable paginacao);

	Page<Livro> findByTituloIgnoreCaseContainingAndSituacao(String titulo, SituacaoLivro situacao, Pageable paginacao);

	Page<Livro> findByAutorIgnoreCaseContainingAndSituacao(String autor, SituacaoLivro situacao, Pageable paginacao);

	Page<Livro> findBySituacao(SituacaoLivro situacao, Pageable paginacao);
}
