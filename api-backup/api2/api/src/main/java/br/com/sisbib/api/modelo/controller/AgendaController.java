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
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.util.UriComponentsBuilder;

import br.com.sisbib.api.modelo.Agenda;
import br.com.sisbib.api.modelo.controller.dto.AgendaDto;
import br.com.sisbib.api.modelo.controller.form.AgendaForm;
import br.com.sisbib.api.modelo.repository.AgendaRepository;

@RestController
@RequestMapping("/agenda")
public class AgendaController {
	
	@Autowired
	private AgendaRepository agendaRepository;
	
	@GetMapping
	public Page<AgendaDto> lista(@PageableDefault(sort = "codigo", direction = Direction.DESC,
			page = 0, size = 10)Pageable paginacao) {
		Page<Agenda> agendas = agendaRepository.findAll(paginacao);
		return AgendaDto.converter(agendas);			
	}
	
	@PostMapping
	@Transactional
	public ResponseEntity<AgendaDto> cadastrar(@RequestBody @Valid AgendaForm form, UriComponentsBuilder uriBuilder) {
		Agenda agenda = form.converter();
		agendaRepository.save(agenda);
		
		URI uri = uriBuilder.path("/agenda/{codigo}").buildAndExpand(agenda.getCodigo()).toUri();
		return ResponseEntity.created(uri).body(new AgendaDto(agenda));
	}
	
	@GetMapping("/{codigo}")
	public ResponseEntity<AgendaDto> detalhar(@PathVariable Long codigo) {
		Optional<Agenda> agenda = agendaRepository.findById(codigo);
		if (agenda.isPresent()) {
			return ResponseEntity.ok(new AgendaDto(agenda.get()));	
		} else {
			return ResponseEntity.notFound().build();
		}
	}
	
	@PutMapping("/{codigo}")
	@Transactional
	public ResponseEntity<AgendaDto> atualizar(@PathVariable Long codigo, @RequestBody @Valid AgendaForm form) {
		Optional<Agenda> optional = agendaRepository.findById(codigo);
		if (optional.isPresent()) {
			Agenda agenda = form.atualizar(codigo, agendaRepository);
			return ResponseEntity.ok(new AgendaDto(agenda));	
		} else {
			return ResponseEntity.notFound().build();
		}
	}
	
	
	@DeleteMapping("/{codigo}")
	@Transactional
	public ResponseEntity<?> deletar(@PathVariable Long codigo) {
		Optional<Agenda> optional = agendaRepository.findById(codigo);
		if (optional.isPresent()) {
			agendaRepository.deleteById(codigo);
			return ResponseEntity.ok().build();
		} else {
			return ResponseEntity.notFound().build();
		}
	}
	
}
