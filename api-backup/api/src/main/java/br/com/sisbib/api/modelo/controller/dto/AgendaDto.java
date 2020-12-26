package br.com.sisbib.api.modelo.controller.dto;

import java.time.LocalDate;
import java.time.LocalTime;

import org.springframework.data.domain.Page;

import br.com.sisbib.api.modelo.Agenda;

public class AgendaDto {
	private Long codigo;
	private LocalDate data;
	private LocalTime horaIni;
	private LocalTime horaFin;
	
	public AgendaDto(Agenda agenda) {
		this.codigo = agenda.getCodigo();
		this.data = agenda.getData();
		this.horaIni = agenda.getHoraIni();
		this.horaFin = agenda.getHoraFin();
	}
	
	public static Page<AgendaDto> converter(Page<Agenda> agenda) {
		return agenda.map(AgendaDto::new);
	}

	public Long getCodigo() {
		return codigo;
	}

	public LocalDate getData() {
		return data;
	}

	public LocalTime getHoraIni() {
		return horaIni;
	}

	public LocalTime getHoraFin() {
		return horaFin;
	}
}
