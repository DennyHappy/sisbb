<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Agenda{

    /**
     * Identificador unico da agenda
     * @var integer
     */
    public $agd_codigo;

    /**
     * Data da criação da agenda
     * @var string
     */
    public $agd_data;

    /**
     * Hora inicial do agendamento do dia
     * @var string
     */
    public $agd_hora_ini;

    /**
     * Hora final do agendamento do dia
     * @var string
     */
    public $agd_hora_fin;

    /**
     * Metodo responsavel por cadastrar uma nova agenda no banco
     * @return boolean
     */
    public function cadastrar(){
        //INSERIR AGENDA NO BANCO
        $obDatabase = new Database('agenda');
        $this->agd_codigo = $obDatabase->insert([
                                'agd_data'      => $this->agd_data,
                                'agd_hora_ini'  => $this->agd_hora_ini,
                                'agd_hora_fin'  => $this->agd_hora_fin,
                            ]);

        //RETORNA SUCESSO
        return true;
    }

    /**
     * Metodo responsavel por atualizar a agenda no banco
     * @return boolean
     */
    public function atualizar(){
        return (new Database('agenda'))->update('agd_codigo = '.$this->agd_codigo,[
                                                                            'agd_data'      => $this->agd_data,
                                                                            'agd_hora_ini'  => $this->agd_hora_ini,
                                                                            'agd_hora_fin'  => $this->agd_hora_fin,
                                                                        ]);
    }

    /**
     * Método responsavel por excluir a agenda do banco
     * @return boolean
     */
    public function excluir(){
        return (new Database('agenda'))->delete('agd_codigo = '.$this->agd_codigo);
    }

    /**
     * Metodo responsavel por obter as agendas no banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getAgendas($where = null, $order = null, $limit = null, $join = null, $and = null, $or = null){
        return (new Database('agenda'))->select($where,$order,$limit)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /**
     * Metodo responsavel por buscar uma agenda com base em seu ID
     * @param integer $id
     * @return Agenda
     */
    public static function getAgenda($id){
        return (new Database('agenda'))->select('agd_codigo = '.$id)
                                        ->fetchObject(self::class);
    }
}
