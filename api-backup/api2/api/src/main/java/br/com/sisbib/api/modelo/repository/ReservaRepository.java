package br.com.sisbib.api.modelo.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import br.com.sisbib.api.modelo.Reserva;

public interface ReservaRepository extends JpaRepository<Reserva, Long>{

}
