package br.com.sisbib.api.modelo.repository;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;

import br.com.sisbib.api.modelo.Livro;

public interface LivroRepository extends JpaRepository<Livro, Long>{
	List<Livro> findByTitulo(String titulo);
}
