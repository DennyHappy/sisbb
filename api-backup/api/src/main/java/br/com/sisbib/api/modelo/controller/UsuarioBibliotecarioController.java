package br.com.sisbib.api.modelo.controller;

import java.net.URI;
import javax.transaction.Transactional;
import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.domain.Sort.Direction;
import org.springframework.data.web.PageableDefault;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.util.UriComponentsBuilder;

import br.com.sisbib.api.modelo.UsuarioBibliotecario;
import br.com.sisbib.api.modelo.controller.dto.UsuarioBibliotecarioDto;
import br.com.sisbib.api.modelo.controller.form.UsuarioBibliotecarioForm;
import br.com.sisbib.api.modelo.repository.UsuarioBibliotecarioRepository;

@RestController
@RequestMapping("/usuariobb")
public class UsuarioBibliotecarioController {
	
	@Autowired
	private UsuarioBibliotecarioRepository usuarioBibliotecarioRepository;
	
	@GetMapping
	public Page<UsuarioBibliotecarioDto> lista(@PageableDefault(sort = "matricula",
			direction = Direction.DESC, page = 0, size = 10)Pageable paginacao) {
		Page<UsuarioBibliotecario> usuarios = usuarioBibliotecarioRepository.findAll(paginacao);
		return UsuarioBibliotecarioDto.converter(usuarios);
	}
	
	@PostMapping
	@Transactional
	public ResponseEntity<UsuarioBibliotecarioDto> cadastrar(@RequestBody @Valid UsuarioBibliotecarioForm form, UriComponentsBuilder uriBuilder){
		UsuarioBibliotecario usuario = form.converter();
		usuarioBibliotecarioRepository.save(usuario);
		
		URI uri = uriBuilder.path("usuariobb/{id}").buildAndExpand(usuario.getMatricula()).toUri();
		return ResponseEntity.created(uri).body(new UsuarioBibliotecarioDto(usuario));
	}
	
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
