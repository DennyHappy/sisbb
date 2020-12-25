package br.com.sisbib.api.modelo.controller.dto;

import java.time.LocalDate;
import java.time.LocalTime;
import java.util.List;
import java.util.stream.Collectors;

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
	
	public static List<AgendaDto> converter(List<Agenda> agenda) {
		return agenda.stream().map(AgendaDto::new).collect(Collectors.toList());
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
