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
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.util.UriComponentsBuilder;

import br.com.sisbib.api.modelo.Usuario;
import br.com.sisbib.api.modelo.controller.dto.UsuarioDto;
import br.com.sisbib.api.modelo.controller.form.UsuarioForm;
import br.com.sisbib.api.modelo.repository.UsuarioRepository;

@RestController
@RequestMapping("/usuario")
public class UsuarioController {
	
	@Autowired
	private UsuarioRepository usuarioRepository;
	
	@GetMapping
	public Page<UsuarioDto> lista(@PageableDefault(sort = "matricula", direction = Direction.DESC,
			page = 0, size = 10)Pageable paginacao) {
		Page<Usuario> usuarios = usuarioRepository.findAll(paginacao);
		return UsuarioDto.converter(usuarios);
	}
	
	@PostMapping
	@Transactional
	public ResponseEntity<UsuarioDto> cadastrar(@RequestBody @Valid UsuarioForm form, UriComponentsBuilder uriBuilder){
		Optional<Usuario> userC = usuarioRepository.findByEmail(form.getEmail());
		
		if(!userC.isPresent()) {
			Usuario usuario = form.converter();
			usuarioRepository.save(usuario);
			
			URI uri = uriBuilder.path("usuariocm/{matricula}").buildAndExpand(usuario.getMatricula()).toUri();
			return ResponseEntity.created(uri).body(new UsuarioDto(usuario));
		} else {
			return ResponseEntity.badRequest().build();
		}
	}
	
	@GetMapping("/{matricula}")
	public ResponseEntity<UsuarioDto> detalhar(@PathVariable Long matricula) {
		Optional<Usuario> userC = usuarioRepository.findById(matricula);
		if (userC.isPresent()) {
			return ResponseEntity.ok(new UsuarioDto(userC.get()));	
		} else {
			return ResponseEntity.notFound().build();
		}
	}
	
	@GetMapping("/{email}")
	public ResponseEntity<UsuarioDto> detalharEmail(@PathVariable String email) {
		Optional<Usuario> userC = usuarioRepository.findByEmail(email);
		if (userC.isPresent()) {
			return ResponseEntity.ok(new UsuarioDto(userC.get()));	
		} else {
			return ResponseEntity.notFound().build();
		}
	}
}
