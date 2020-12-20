<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Usuario_Bibliotecario{

    /**
     * Identificador unico do usuario
     * @var string
     */
    public $userB_matricula;

    /**
     * Nome do usuario
     * @var string
     */
    public $userB_nome;

    /**
     * Email de Login
     * @var string
     */
    public $userB_email;

    /**
     * Id do Usuario
     * @var string
     */
    public $userB_idUser;

    /**
     * Metodo responsavel por cadastrar um novo usuario no banco
     * @return boolean
     */
    public function cadastrar(){
        //INSERIR USUARIO NO BANCO
        $obDatabase = new Database('usuario_bibliotecario');
        $this->userC_matricula = $obDatabase->insert([
                                'userB_matricula' => $this->userB_matricula,
                                'userB_nome'  => $this->userB_nome,
                                'userB_email'  => $this->userB_email,
                                'userB_idUser'  => $this->userB_idUser,
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
        return (new Database('usuario_bibliotecario'))->select($where,$order,$limit)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /**
     * Metodo responsavel por buscar um usuario com base em seu ID
     * @param integer $email
     * @return Usuario_Comum
     */
    public static function getUsuario($email){
        return (new Database('usuario_bibliotecario'))->select('userB_email = '.$email)
                                        ->fetchObject(self::class);
    }
}
