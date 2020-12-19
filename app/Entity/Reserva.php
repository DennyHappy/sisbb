<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;  

class Reserva{

    /**
     * Identificador unico da reserva
     * @var integer
     */
    public $rsv_codigo;

    /**
     * Tipo da reserva
     * @var string (retirada/devolucao)
     */
    public $rsv_tipo_reserva;

    /**
     * Data da reserva
     * @var string
     */
    public $rsv_data_reserva;

    /**
     * Hora da reserva
     * @var string
     */
    public $rsv_hora_reserva;

    /**
     * Status da reserva
     * @var string (ativa/concluida)
     */
    public $rsv_status_reserva;

    /**
     * Matricula do usuario atrelado a reserva
     * @var integer
     */
    public $rsv_matricula_userC;

    /**
     * Codigo da agenda a qual a reserva pertence
     * @var integer
     */
    public $rsv_codigo_agenda;

    /**
     * Metodo responsavel por cadastrar uma nova reserva no banco
     * @return boolean
     */
    public function cadastrar(){
        //INSERIR RESERVA NO BANCO
        $obDatabase = new Database('reserva');
        $this->rsv_codigo = $obDatabase->insert([
                                'rsv_data_reserva' => $this->rsv_data_reserva,
                                'rsv_hora_reserva' => $this->rsv_hora_reserva,
                                'rsv_matricula_userC' => $this->rsv_matricula_userC,
                                'rsv_codigo_agenda' => $this->rsv_codigo_agenda
                            ]);
        //echo "<pre>"; print_r($this); echo "</pre>"; exit;
        //RETORNA SUCESSO
        return true;
    }

    /**
     * Metodo responsavel por atualizar a agenda no banco
     * @return boolean
     */
    public function atualizar(){
        return (new Database('reserva'))->update('rsv_codigo = '.$this->rsv_codigo,[
                                                                            'rsv_status_reserva' => $this->rsv_status_reserva
                                                                        ]);
    }

    /**
     * Metodo responsavel por obter as reservas no banco de dados com base no ID da agenda ao qual pertence
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getReservas($where = null){
        return (new Database('reserva'))->select($where)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /**
     * Metodo responsavel por buscar uma reserva com base em seu ID
     * @param integer $id
     * @return Agenda
     */
    public static function getReserva($id){
        return (new Database('reserva'))->select('rsv_codigo = '.$id)
                                        ->fetchObject(self::class);
    }

    /**
     * Metodo responsavel por buscar uma reserva com base na data e o horario escolhido para uma reserva
     * @param integer $id
     * @return Agenda
     */
    public static function getReserva_2($data,$hora){
        return (new Database('reserva'))->select('rsv_data_reserva = '.$data.' and rsv_hora_reserva = '.$hora)
                                        ->fetchObject(self::class);
    }
}
