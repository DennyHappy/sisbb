package br.com.sisbib.api.modelo;

import java.time.LocalDate;
import java.time.LocalTime;
import java.util.List;

import javax.persistence.Entity;
import javax.persistence.EnumType;
import javax.persistence.Enumerated;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinTable;
import javax.persistence.ManyToMany;
import javax.persistence.ManyToOne;

@Entity
public class Reserva {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long codigo;
	
	@Enumerated(EnumType.STRING)
	private TipoReserva tipoReserva;
	
	private LocalDate dataReserva;
	private LocalTime horaReserva;
	
	@Enumerated(EnumType.STRING)
	private StatusReserva statusReserva = StatusReserva.ATIVA;
	
	@ManyToOne
	private Usuario requisitante;
	
	@ManyToOne
	private Agenda agenda;
	
	@ManyToMany
	@JoinTable(name = "reserva_livros")
	private List<Livro> livros;
	
	public Reserva() {
		
	}

	public Reserva(TipoReserva tipoReserva, LocalDate dataReserva, LocalTime horaReserva, Usuario requisitante,
			Agenda agenda, List<Livro> livros) {
		this.tipoReserva = tipoReserva;
		this.dataReserva = dataReserva;
		this.horaReserva = horaReserva;
		this.requisitante = requisitante;
		this.agenda = agenda;
		this.livros = livros;
	}

	public Long getCodigo() {
		return codigo;
	}

	public TipoReserva getTipoReserva() {
		return tipoReserva;
	}

	public LocalDate getDataReserva() {
		return dataReserva;
	}

	public LocalTime getHoraReserva() {
		return horaReserva;
	}

	public StatusReserva getStatusReserva() {
		return statusReserva;
	}

	public Usuario getRequisitante() {
		return requisitante;
	}

	public Agenda getAgenda() {
		return agenda;
	}

	public List<Livro> getLivros() {
		return livros;
	}
	
	public void setStatusReserva(StatusReserva statusReserva) {
		this.statusReserva = statusReserva;
	}
	
	public void setDataReserva(LocalDate dataReserva) {
		this.dataReserva = dataReserva;
	}
	
	public void setHoraReserva(LocalTime horaReserva) {
		this.horaReserva = horaReserva;
	}
	
	public void setAgenda(Agenda agenda) {
		this.agenda = agenda;
	}
}
