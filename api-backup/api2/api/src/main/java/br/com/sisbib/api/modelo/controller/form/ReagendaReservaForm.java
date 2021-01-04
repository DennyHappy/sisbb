package br.com.sisbib.api.modelo.controller.form;

import java.time.LocalDate;
import java.time.LocalTime;
import javax.validation.constraints.NotNull;

import br.com.sisbib.api.modelo.Agenda;
import br.com.sisbib.api.modelo.Reserva;
import br.com.sisbib.api.modelo.repository.ReservaRepository;

public class ReagendaReservaForm {
	@NotNull
	private Long codigoAgenda;
	@NotNull
	private LocalDate dataReserva;
	@NotNull
	private LocalTime horaReserva;
	
	public Long getCodigoAgenda() {
		return codigoAgenda;
	}

	public void setCodigoAgenda(Long codigoAgenda) {
		this.codigoAgenda = codigoAgenda;
	}

	public LocalDate getDataReserva() {
		return dataReserva;
	}

	public void setDataReserva(LocalDate dataReserva) {
		this.dataReserva = dataReserva;
	}

	public LocalTime getHoraReserva() {
		return horaReserva;
	}

	public void setHoraReserva(LocalTime horaReserva) {
		this.horaReserva = horaReserva;
	}

	public Reserva atualizar(Long codigo, ReservaRepository reservaRepository, Agenda agenda) {
		Reserva reserva = reservaRepository.getOne(codigo);
		
		reserva.setDataReserva(dataReserva);
		reserva.setHoraReserva(horaReserva);
		reserva.setAgenda(agenda);
		
		return reserva;		
	}
}
