<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Usuario_Comum{

    /**
     * Identificador unico do usuario
     * @var string
     */
    public $userC_matricula;

    /**
     * Nome do usuario
     * @var string
     */
    public $userC_nome;

    /**
     * Email de Login
     * @var string
     */
    public $userC_email;

    /**
     * Id do Usuario
     * @var string
     */
    public $userC_idUser;

    /**
     * Metodo responsavel por cadastrar um novo usuario no banco
     * @return boolean
     */
    public function cadastrar(){
        //INSERIR USUARIO NO BANCO
        $obDatabase = new Database('usuario_comum');
        $this->userC_matricula = $obDatabase->insert([
                                'userC_matricula' => $this->userC_matricula,
                                'userC_nome'  => $this->userC_nome,
                                'userC_email'  => $this->userC_email,
                                'userC_idUser'  => $this->userC_idUser,
                            ]);

        //RETORNA SUCESSO
        return true;
    }

    /**
     * Metodo responsavel por obter os usuarios no banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getUsuarios($where = null, $order = null, $limit = null, $join = null, $and = null, $or = null){
        return (new Database('usuario_comum'))->select($where,$order,$limit)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /**
     * Metodo responsavel por buscar um usuario com base em seu ID
     * @param integer $email
     * @return Usuario_Comum
     */
    public static function getUsuario($email){
        return (new Database('usuario_comum'))->select('userC_email = '.$email)
                                        ->fetchObject(self::class);
    }
}
