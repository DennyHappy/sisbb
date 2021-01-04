package br.com.sisbib.api.modelo.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import br.com.sisbib.api.modelo.Agenda;

public interface AgendaRepository extends JpaRepository<Agenda, Long>{

}
