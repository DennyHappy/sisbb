<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Itens_Reserva extends Reserva{

    /**
     * Identificador unico do iten de reserva
     * @var integer
     */
    public $it_rsv_codigo;

    /**
     * Identificador da reserva ao qual o item pertence
     * @var integer
     */
    public $it_rsv_cod_reserva;

    /**
     * Codigo de barras itentificador do livro registrado no item de reserva
     * @var integer
     */
    public $it_rsv_cod_barra_livro;

    /**
     * Metodo responsavel por obter os itens de reserva no banco de dados com base no ID da reserva ao qual pertence
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getItensReservas($where = null){
        return (new Database('item_reserva'))->select($where)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

}
