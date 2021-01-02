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
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.util.UriComponentsBuilder;

import br.com.sisbib.api.modelo.Agenda;
import br.com.sisbib.api.modelo.Reserva;
import br.com.sisbib.api.modelo.controller.dto.ReservaDto;
import br.com.sisbib.api.modelo.controller.form.AtualizaReservaForm;
import br.com.sisbib.api.modelo.controller.form.ReagendaReservaForm;
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
	public Page<ReservaDto> lista(@PageableDefault(sort = "codigo",
			direction = Direction.DESC, page = 0, size = 10)Pageable paginacao) {
		Page<Reserva> reservas = reservaRepository.findAll(paginacao);
		return ReservaDto.converter(reservas);
	}
	
	@PostMapping
	@Transactional
	public ResponseEntity<ReservaDto> cadastrar(@RequestBody @Valid ReservaForm form, UriComponentsBuilder uriBuilder) {
		Reserva reserva = form.converter(agendaRepository, usuarioComumRepository, livroRepository);
		reservaRepository.save(reserva);
		
		URI uri = uriBuilder.path("/reserva/{codigo}").buildAndExpand(reserva.getCodigo()).toUri();
		return ResponseEntity.created(uri).body(new ReservaDto(reserva));
	}
	
	@GetMapping("/{codigo}")
	public ResponseEntity<ReservaDto> detalhar(@PathVariable Long codigo) {
		Optional<Reserva> reserva = reservaRepository.findById(codigo);
		if (reserva.isPresent()) {
			return ResponseEntity.ok(new ReservaDto(reserva.get()));	
		} else {
			return ResponseEntity.notFound().build();
		}
	}
	
	@PutMapping("/{codigo}")
	@Transactional
	public ResponseEntity<ReservaDto> atualizar(@PathVariable Long codigo, @RequestBody @Valid AtualizaReservaForm form) {
		Optional<Reserva> optional = reservaRepository.findById(codigo);
		if (optional.isPresent()) {
			Reserva reserva = form.atualizar(codigo, reservaRepository);
			return ResponseEntity.ok(new ReservaDto(reserva));
		} else {
			return ResponseEntity.notFound().build();
		}
	}
	
	@PutMapping("/reagendar/{codigo}")
	@Transactional
	public ResponseEntity<ReservaDto> reagendar(@PathVariable Long codigo, @RequestBody @Valid ReagendaReservaForm form) {
		Optional<Reserva> optional = reservaRepository.findById(codigo);
		if (optional.isPresent()) {
			Long codigoAgenda = form.getCodigoAgenda();
			Optional<Agenda> agenda = agendaRepository.findById(codigoAgenda);
			if(agenda.isPresent()) {
				Reserva reserva = form.atualizar(codigo, reservaRepository, agenda.get());
				return ResponseEntity.ok(new ReservaDto(reserva));
			}
		}
		return ResponseEntity.notFound().build();
	}
}
