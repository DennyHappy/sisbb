package br.com.sisbib.api.modelo.controller.dto;

import java.time.LocalDate;
import java.time.LocalTime;
import java.util.ArrayList;
import java.util.List;
import java.util.stream.Collectors;

import br.com.sisbib.api.modelo.Livro;
import br.com.sisbib.api.modelo.Reserva;
import br.com.sisbib.api.modelo.TipoReserva;

public class ReservaDto {
	private Long codigo;
	private TipoReserva tipoReserva;
	private LocalDate dataReserva;
	private LocalTime horaReserva;
	private Long matricula;
	private String nomeUsuario;
	private Long codigoAgenda;
	private List<Long> codBarras = new ArrayList<Long>();
	private List<String> titulos = new ArrayList<String>();

	public ReservaDto(Reserva reserva) {
		this.codigo = reserva.getCodigo();
		this.tipoReserva = reserva.getTipoReserva();
		this.dataReserva = reserva.getDataReserva();
		this.horaReserva = reserva.getHoraReserva();
		this.matricula = reserva.getRequisitante().getMatricula();
		this.nomeUsuario = reserva.getRequisitante().getNome();
		this.codigoAgenda = reserva.getAgenda().getCodigo();
		for (Livro livro : reserva.getLivros()) {
			this.codBarras.add(livro.getCodBarras());
			this.titulos.add(livro.getTitulo());
		}
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

	public Long getMatricula() {
		return matricula;
	}

	public String getNomeUsuario() {
		return nomeUsuario;
	}

	public Long getCodigoAgenda() {
		return codigoAgenda;
	}

	public List<Long> getCodBarras() {
		return codBarras;
	}

	public List<String> getTitulos() {
		return titulos;
	}
	
	public static List<ReservaDto> converter(List<Reserva> reservas) {
		return reservas.stream().map(ReservaDto::new).collect(Collectors.toList());
	}
}
