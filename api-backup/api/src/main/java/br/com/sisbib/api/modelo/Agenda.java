package br.com.sisbib.api.modelo;

import java.time.LocalDate;
import java.time.LocalTime;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.validation.constraints.NotNull;

@Entity
public class Agenda {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long codigo;
	private LocalDate data;
	private LocalTime horaIni;
	private LocalTime horaFin;
	
	public Agenda() {
		
	}
	
	public Agenda(LocalDate data, LocalTime horaIni, LocalTime horaFin) {
		this.data = data;
		this.horaIni = horaIni;
		this.horaFin = horaFin;
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
	
	public void setData(LocalDate data) {
		this.data = data;
	}
	
	public void setHoraIni(LocalTime horaIni) {
		this.horaIni = horaIni;
	}
	
	public void setHoraFin(LocalTime horaFin) {
		this.horaFin = horaFin;
	}
}
