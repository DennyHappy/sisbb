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
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;

@Entity
public class Reserva {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long codigo;
	
	@Enumerated(EnumType.STRING)
	private TipoReserva tipo_reserva;
	
	private LocalDate data_reserva;
	private LocalTime hora_reserva;
	
	@Enumerated(EnumType.STRING)
	private StatusReserva status_reserva = StatusReserva.ATIVA;
	
	@ManyToOne
	private UsuarioComum requisitante;
	
	@ManyToOne
	private Agenda agenda;
	
	@OneToMany
	private List<Livro> livros;
	
	public Reserva() {
		
	}

	public Reserva(TipoReserva tipo_reserva, LocalDate data_reserva, LocalTime hora_reserva, UsuarioComum requisitante,
			Agenda agenda, List<Livro> livros) {
		this.tipo_reserva = tipo_reserva;
		this.data_reserva = data_reserva;
		this.hora_reserva = hora_reserva;
		this.requisitante = requisitante;
		this.agenda = agenda;
		this.livros = livros;
	}

	public Long getCodigo() {
		return codigo;
	}

	public TipoReserva getTipo_reserva() {
		return tipo_reserva;
	}

	public LocalDate getData_reserva() {
		return data_reserva;
	}

	public LocalTime getHora_reserva() {
		return hora_reserva;
	}

	public StatusReserva getStatus_reserva() {
		return status_reserva;
	}

	public UsuarioComum getRequisitante() {
		return requisitante;
	}

	public Agenda getAgenda() {
		return agenda;
	}

	public List<Livro> getLivros() {
		return livros;
	}
}
