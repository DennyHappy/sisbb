package br.com.sisbib.api.modelo.controller;

import java.net.URI;
import java.util.List;

import javax.transaction.Transactional;
import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.util.UriComponentsBuilder;

import br.com.sisbib.api.modelo.Livro;
import br.com.sisbib.api.modelo.controller.dto.LivroDto;
import br.com.sisbib.api.modelo.controller.form.LivroForm;
import br.com.sisbib.api.modelo.repository.LivroRepository;

@RestController
@RequestMapping("/livro")
public class LivroController {
	
	@Autowired
	private LivroRepository livroRepository;
	
	@GetMapping
	public List<LivroDto> lista(String titulo) {
		if (titulo == null) {
			List<Livro> livros = livroRepository.findAll();
			return LivroDto.converter(livros);			
		} else {
			List<Livro> livros = livroRepository.findByTitulo(titulo);
			return LivroDto.converter(livros);		
		}
	}
	
	@PostMapping
	@Transactional
	public ResponseEntity<LivroDto> cadastrar(@RequestBody @Valid LivroForm form, UriComponentsBuilder uriBuilder) {
		Livro livro = form.converter();
		livroRepository.save(livro);
		
		URI uri = uriBuilder.path("/livro/{id}").buildAndExpand(livro.getCodBarras()).toUri();
		return ResponseEntity.created(uri).body(new LivroDto(livro));
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
//	@PutMapping("/{id}")
//	@Transactional
//	public ResponseEntity<TopicoDto> atualizar(@PathVariable Long id, @RequestBody @Valid AtualizacaoTopicoForm form) {
//		Optional<Topico> optional = topicoRepository.findById(id);
//		if (optional.isPresent()) {
//			Topico topico = form.atualizar(id, topicoRepository);
//			return ResponseEntity.ok(new TopicoDto(topico));	
//		} else {
//			return ResponseEntity.notFound().build();
//		}
//	}
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
