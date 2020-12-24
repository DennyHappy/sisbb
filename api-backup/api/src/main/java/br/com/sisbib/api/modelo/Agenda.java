package br.com.sisbib.api.modelo;

import java.time.LocalDate;
import java.time.LocalTime;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

@Entity
public class Agenda {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long codigo;
	private LocalDate data;
	private LocalTime hora_ini;
	private LocalTime hora_fin;
	
	public Agenda() {
		
	}
	
	public Agenda(LocalDate data, LocalTime hora_ini, LocalTime hora_fin) {
		this.data = data;
		this.hora_ini = hora_ini;
		this.hora_fin = hora_fin;
	}

	public Long getCodigo() {
		return codigo;
	}

	public LocalDate getData() {
		return data;
	}

	public LocalTime getHora_ini() {
		return hora_ini;
	}

	public LocalTime getHora_fin() {
		return hora_fin;
	}
}
