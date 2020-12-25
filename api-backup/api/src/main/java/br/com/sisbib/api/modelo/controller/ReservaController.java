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

import br.com.sisbib.api.modelo.Reserva;
import br.com.sisbib.api.modelo.controller.dto.ReservaDto;
import br.com.sisbib.api.modelo.controller.form.ReservaForm;
import br.com.sisbib.api.modelo.repository.AgendaRepository;
import br.com.sisbib.api.modelo.repository.LivroRepository;
import br.com.sisbib.api.modelo.repository.ReservaRepository;
import br.com.sisbib.api.modelo.repository.UsuarioComumRepository;

@RestController
@RequestMapping("/reserva")
public class ReservaController {
	
	@Autowired
	private ReservaRepository reservaRepository;
	
	@Autowired
	private AgendaRepository agendaRepository;
	
	@Autowired
	private UsuarioComumRepository usuarioComumRepository;
	
	@Autowired
	private LivroRepository livroRepository;
	
	@GetMapping
	public List<ReservaDto> lista() {
		List<Reserva> reservas = reservaRepository.findAll();
		return ReservaDto.converter(reservas);
	}
	
	@PostMapping
	@Transactional
	public ResponseEntity<ReservaDto> cadastrar(@RequestBody @Valid ReservaForm form, UriComponentsBuilder uriBuilder) {
		Reserva reserva = form.converter(agendaRepository, usuarioComumRepository, livroRepository);
		reservaRepository.save(reserva);
		
		URI uri = uriBuilder.path("/reserva/{id}").buildAndExpand(reserva.getCodigo()).toUri();
		return ResponseEntity.created(uri).body(new ReservaDto(reserva));
	}
	
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
