package br.com.sisbib.api.modelo.controller;

import java.net.URI;
import java.util.Optional;

import javax.transaction.Transactional;
import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.domain.Sort.Direction;
import org.springframework.data.web.PageableDefault;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.util.UriComponentsBuilder;

import br.com.sisbib.api.modelo.Livro;
import br.com.sisbib.api.modelo.SituacaoLivro;
import br.com.sisbib.api.modelo.controller.dto.LivroDto;
import br.com.sisbib.api.modelo.controller.form.LivroForm;
import br.com.sisbib.api.modelo.controller.form.SituacaoLivroForm;
import br.com.sisbib.api.modelo.repository.LivroRepository;

@RestController
@RequestMapping("/livro")
public class LivroController {
	
	@Autowired
	private LivroRepository livroRepository;
	
	@GetMapping
	public Page<LivroDto> lista(@RequestParam(required = false) String titulo, 
			@RequestParam(required = false) String autor, @RequestParam(required = false) SituacaoLivro situacao, 
			@PageableDefault(sort = "codBarras", direction = Direction.DESC, page = 0, size = 10)Pageable paginacao) {
		if (titulo == null && autor == null && situacao == null) {
			Page<Livro> livros = livroRepository.findAll(paginacao);
			return LivroDto.converter(livros);			
		} else if(autor == null && situacao == null){
			Page<Livro> livros = livroRepository.findByTituloIgnoreCaseContaining(titulo, paginacao);
			return LivroDto.converter(livros);		
		} else if(titulo == null && situacao == null){
			Page<Livro> livros = livroRepository.findByAutorIgnoreCaseContaining(autor, paginacao);
			return LivroDto.converter(livros);		
		} else if(autor == null && titulo == null) {
			Page<Livro> livros = livroRepository.findBySituacao(situacao, paginacao);
			return LivroDto.converter(livros);
		} else if(autor == null) {
			Page<Livro> livros = livroRepository.findByTituloIgnoreCaseContainingAndSituacao(titulo, situacao, paginacao);
			return LivroDto.converter(livros);
		} else {
			Page<Livro> livros = livroRepository.findByAutorIgnoreCaseContainingAndSituacao(autor, situacao, paginacao);
			return LivroDto.converter(livros);			
		}
	}
	
	@PostMapping
	@Transactional
	public ResponseEntity<LivroDto> cadastrar(@RequestBody @Valid LivroForm form, UriComponentsBuilder uriBuilder) {
		Livro livro = form.converter();
		livroRepository.save(livro);
		
		URI uri = uriBuilder.path("/livro/{codBarras}").buildAndExpand(livro.getCodBarras()).toUri();
		return ResponseEntity.created(uri).body(new LivroDto(livro));
	}
	
	@GetMapping("/{codBarras}")
	public ResponseEntity<LivroDto> detalhar(@PathVariable Long codBarras) {
		Optional<Livro> livro = livroRepository.findById(codBarras);
		if (livro.isPresent()) {
			return ResponseEntity.ok(new LivroDto(livro.get()));	
		} else {
			return ResponseEntity.notFound().build();
		}
	}
	
	@PutMapping("/{codBarras}")
	@Transactional
	public ResponseEntity<LivroDto> atualizar(@PathVariable Long codBarras, @RequestBody @Valid SituacaoLivroForm form) {
		Optional<Livro> optional = livroRepository.findById(codBarras);
		if (optional.isPresent()) {
			Livro livro = form.atualizar(codBarras, livroRepository);
			return ResponseEntity.ok(new LivroDto(livro));	
		} else {
			return ResponseEntity.notFound().build();
		}
	}
//	
//	@PostMapping
//	@Transactional
//	public ResponseEntity<TopicoDto> cadastrar(@RequestBody @Valid TopicoForm form, UriComponentsBuilder uriBuilder) {
//		Topico topico = form.converter(cursoRepository);
//		topicoRepository.save(topico);
//		
//		URI uri = uriBuilder.path("/topicos/{id}").buildAndExpand(topico.getId()).toUri();
//		return ResponseEntity.created(uri).body(new TopicoDto(topico));
//	}
//	
//	@GetMapping("/{id}")
//	public ResponseEntity<DetalhesTopicoDto> detalhar(@PathVariable Long id) {
//		Optional<Topico> topico = topicoRepository.findById(id);
//		if (topico.isPresent()) {
//			return ResponseEntity.ok(new DetalhesTopicoDto(topico.get()));	
//		} else {
//			return ResponseEntity.notFound().build();
//		}
//	}
//
//	
//	
//	@DeleteMapping("/{id}")
//	@Transactional
//	public ResponseEntity<?> deletar(@PathVariable Long id) {
//		Optional<Topico> optional = topicoRepository.findById(id);
//		if (optional.isPresent()) {
//			topicoRepository.deleteById(id);
//			return ResponseEntity.ok().build();
//		} else {
//			return ResponseEntity.notFound().build();
//		}
//	}
	
}
