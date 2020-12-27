package br.com.sisbib.api.modelo.controller.form;

import java.time.LocalDate;

import java.time.LocalTime;

import javax.validation.constraints.NotNull;

import br.com.sisbib.api.modelo.Agenda;
import br.com.sisbib.api.modelo.repository.AgendaRepository;

public class AgendaForm {
	@NotNull
	private LocalDate data;
	@NotNull
	private LocalTime horaIni;
	@NotNull
	private LocalTime horaFin;
	
	public LocalDate getData() {
		return data;
	}
	public void setData(LocalDate data) {
		this.data = data;
	}
	public LocalTime getHoraIni() {
		return horaIni;
	}
	public void setHoraIni(LocalTime horaIni) {
		this.horaIni = horaIni;
	}
	public LocalTime getHoraFin() {
		return horaFin;
	}
	public void setHoraFin(LocalTime horaFin) {
		this.horaFin = horaFin;
	}
	
	public Agenda converter() {
		return new Agenda(data, horaIni, horaFin);
	}
	
	public Agenda atualizar(Long codigo, AgendaRepository agendaRepository) {
		Agenda agenda = agendaRepository.getOne(codigo);
		
		agenda.setData(this.data);
		agenda.setHoraIni(this.horaIni);
		agenda.setHoraFin(this.horaFin);
		
		return agenda;
	}
}