<?php

namespace App\Db;

use \PDO;
use \PDOException;   

class Database{
    /**
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = 'sisbiblioteca';

    /**
     * Usuario do banco de dados
     * @var string
     */
    const USER = 'root';

    /**
     * Senha de acesso ao banco de dados
     * @var string
     */
    const PASS = '';

    /**
     * Nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instancia de conexão com o banco de dados
     * @var PDO
     */
    private $connection;

    /**
     * Define a tabela e instania a conexão
     * @param string $table
     */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Metodo responsavel por criar uma conexão com o banco de dados
     */
    public function setConnection(){
        try {
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: '.$e->getMessage());
        }
    }

    /**
     * Metodo responsavel por executar queries dentro do banco de dados
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query,$params = []){
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            return $statement;
        } catch (PDOException $e) {
            die('ERROR: '.$e->getMessage());
        }
    }

    /**
     * Metodo responsavel por inserir dados no banco
     * @param array $values [ field => value ]
     * @return integer ID inserido
     */
    public function insert($values){
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([],count($fields),'?');

        //MONTA QUERY
        $query = 'insert into '.$this->table.' ('.implode(',',$fields).') values ('.implode(',',$binds).')';

        //EXECUTA O INSERT
        $this->execute($query,array_values($values));

        //RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
    }

    /**
     * Metodo responsavel por executar uma consulta no banco
     * @param string $where
     * @param string $join
     * @param string $and
     * @param string $or
     * @param string $like
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where = null, $join = null, $and = null, $like = null, $or = null, $order = null, $limit = null, $fields = '*'){
        //DADOS DA QUERY
        $where = strlen($where) ? 'where '.$where : '';
        $order = strlen($order) ? 'order by '.$order : '';
        $limit = strlen($limit) ? 'limit '.$limit : '';
        $join = strlen($join) ? ','.$join : '';
        $and = strlen($and) ? 'and '.$and : '';
        $or = strlen($or) ? 'or '.$or : '';
        $like = strlen($like) ? 'like '.$like : '';

        //MONTA A QUERY
        if(isset($and,$join)){
            $query = 'select '.$fields.' from '.$this->table.''.$join.' '.$where.' '.$and.' '.$order.' '.$limit;
        }
        if(isset($like)){
            $query = 'select '.$fields.' from '.$this->table.''.$join.' '.$where.' '.$like.' '.$order.' '.$limit;
        }

        //echo "<pre>"; print_r($query); echo "</pre>"; exit;
        //EXECUTA A QUERY
        return $this->execute($query);
    }

    /**
     * Metodo responsavel pro executar atualizações no banco de dados
     * @param string $where
     * @param array $values [ field => value ]
     * @return boolean
     */
    public function update($where,$values){
        //DADOS DA QUERY
        $fields = array_keys($values);

        //MONTA A QUERY
        $query = 'update '.$this->table.' set '.implode('=?,',$fields).'=? where '.$where;
        
        //echo "<pre>"; print_r($query); echo "</pre>"; exit;
        //EXECUTAR A QUERY
        $this->execute($query,array_values($values));

        //RETORNA SUCESSO
        return true;
    }

    /**
     * Método responsavel por excluir ddados do banco
     * @param string $where
     * @return boolean
     */
    public function delete($where){
        //MONTA A QUERY
        $query = 'delete from '.$this->table.' where '.$where;

        //EXECUTA A QUERY
        $this->execute($query);

        //RETORNA SUCESSO
        return true;
    }
}

