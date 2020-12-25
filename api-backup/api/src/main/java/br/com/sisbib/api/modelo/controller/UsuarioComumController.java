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

import br.com.sisbib.api.modelo.UsuarioComum;
import br.com.sisbib.api.modelo.controller.dto.UsuarioComumDto;
import br.com.sisbib.api.modelo.controller.form.UsuarioComumForm;
import br.com.sisbib.api.modelo.repository.UsuarioComumRepository;

@RestController
@RequestMapping("/usuariocm")
public class UsuarioComumController {
	
	@Autowired
	private UsuarioComumRepository usuarioComumRepository;
	
	@GetMapping
	public List<UsuarioComumDto> lista() {
		List<UsuarioComum> usuarios = usuarioComumRepository.findAll();
		return UsuarioComumDto.converter(usuarios);
	}
	
	@PostMapping
	@Transactional
	public ResponseEntity<UsuarioComumDto> cadastrar(@RequestBody @Valid UsuarioComumForm form, UriComponentsBuilder uriBuilder){
		UsuarioComum usuario = form.converter();
		usuarioComumRepository.save(usuario);
		
		URI uri = uriBuilder.path("usuariocm/{id}").buildAndExpand(usuario.getMatricula()).toUri();
		return ResponseEntity.created(uri).body(new UsuarioComumDto(usuario));
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
