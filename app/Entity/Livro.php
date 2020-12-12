<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Livro extends Itens_Reserva{

    /**
     * Identificador unico do Livro
     * @var integer
     */
    public $lv_cod_barras;

    /**
     * Codigo do patrimonio do Livro
     * @var integer
     */
    public $lv_patrimonio;

    /**
     * Localização do Livro na biblioteca
     * @var string
     */
    public $lv_localizacao;

    /**
     * Titulo do Livro
     * @var string
     */
    public $lv_titulo;

    /**
     * Nome do autor do Livro
     * @var string
     */
    public $lv_autor;

    /**
     * Numero da edição do Livro
     * @var string
     */
    public $lv_edicao;

    /**
     * Ano de publicação do Livro
     * @var string
     */
    public $lv_ano;

    /**
     * Volume do Livro
     * @var string
     */
    public $lv_volume;

    /**
     * Situação em que o Livro se encontra no arcevo
     * @var string (disponivel/emprestado/quarentena)
     */
    public $lv_situacao;

    /**
     * Data em que o Livro foi posto em quarentena
     * @var string
     */
    public $lv_data_quarentena;

    /**
     * Metodo responsavel por atualizar o livro no banco
     * @return boolean
     */
    public function atualizar(){
        return (new Database('livro'))->update('lv_cod_barras = '.$this->lv_cod_barras,[
                                                                            'lv_situacao' => $this->lv_situacao,
                                                                            'lv_data_quarentena' => $this->lv_data_quarentena
                                                                        ]);
    }

    /**
     * Metodo responsavel por obter os Livros no banco de dados
     * @param string $where
     * @param string $join
     * @param string $and
     * @param string $like
     * @return array
     */
    public static function getLivros($where = null, $join = null, $and = null, $like = null){
        return (new Database('livro'))->select($where,$join,$and,$like)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /**
     * Metodo responsavel por buscar um Livro com base em seu ID
     * @param integer $id
     * @return Livro
     */
    public static function getLivro($id){
        return (new Database('livro'))->select('lv_cod_barras = '.$id)
                                        ->fetchObject(self::class);
    }


}
