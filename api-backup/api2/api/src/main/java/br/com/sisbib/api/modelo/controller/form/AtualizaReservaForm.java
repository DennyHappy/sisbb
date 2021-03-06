package br.com.sisbib.api.modelo.controller.form;

import javax.validation.constraints.NotNull;

import br.com.sisbib.api.modelo.Reserva;
import br.com.sisbib.api.modelo.StatusReserva;
import br.com.sisbib.api.modelo.repository.ReservaRepository;

public class AtualizaReservaForm {
	@NotNull
	private StatusReserva statusReserva = StatusReserva.ATIVA;
	
	public StatusReserva getStatusReserva() {
		return statusReserva;
	}
	
	public void setStatusReserva(StatusReserva statusReserva) {
		this.statusReserva = statusReserva;
	}
	
	public Reserva atualizar(Long codigo, ReservaRepository reservaRepository) {
		Reserva reserva = reservaRepository.getOne(codigo);
		
		reserva.setStatusReserva(this.statusReserva);
		
		return reserva;
	}
}
