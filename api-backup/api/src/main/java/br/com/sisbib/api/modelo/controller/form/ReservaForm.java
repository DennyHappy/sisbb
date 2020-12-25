package br.com.sisbib.api.modelo.controller.form;

import java.time.LocalDate;
import java.time.LocalTime;
import java.util.List;

import javax.validation.constraints.NotNull;

import br.com.sisbib.api.modelo.Agenda;
import br.com.sisbib.api.modelo.Livro;
import br.com.sisbib.api.modelo.Reserva;
import br.com.sisbib.api.modelo.TipoReserva;
import br.com.sisbib.api.modelo.UsuarioComum;
import br.com.sisbib.api.modelo.repository.AgendaRepository;
import br.com.sisbib.api.modelo.repository.LivroRepository;
import br.com.sisbib.api.modelo.repository.UsuarioComumRepository;

public class ReservaForm {
	
	@NotNull
	private TipoReserva tipoReserva;
	@NotNull
	private LocalDate dataReserva;
	@NotNull
	private LocalTime horaReserva;
	@NotNull
	private Long matricula;
	@NotNull
	private Long codigoAgenda;
	@NotNull
	private List<Long> codBarras;
	
	public TipoReserva getTipoReserva() {
		return tipoReserva;
	}

	public void setTipoReserva(TipoReserva tipoReserva) {
		this.tipoReserva = tipoReserva;
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

	public Long getMatricula() {
		return matricula;
	}

	public void setMatricula(Long matricula) {
		this.matricula = matricula;
	}

	public Long getCodigoAgenda() {
		return codigoAgenda;
	}

	public void setCodigoAgenda(Long codigoAgenda) {
		this.codigoAgenda = codigoAgenda;
	}

	public List<Long> getCodBarras() {
		return codBarras;
	}

	public void setCodBarras(List<Long> codBarras) {
		this.codBarras = codBarras;
	}

	@Override
		public String toString() {
			// TODO Auto-generated method stub
			return tipoReserva.toString() + " - " + matricula.toString() + " - " + codigoAgenda.toString();
		}
	
	public Reserva converter(AgendaRepository agendaRepository, UsuarioComumRepository usuarioRepository, 
			LivroRepository livroRepository) {
		Agenda agenda = agendaRepository.getOne(codigoAgenda);
		UsuarioComum usuario = usuarioRepository.getOne(matricula);
		List<Livro> livro = livroRepository.findAllById(codBarras);
		
		return new Reserva(tipoReserva, dataReserva, horaReserva, usuario, agenda, livro);
	}
}
