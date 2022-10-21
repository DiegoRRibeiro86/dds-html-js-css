<?php
/**
 * Model produtos
 * 
 * @author Wanderlei Silva do Carmo <wander.silva@gmail.com>
 * @version 1.0
 * 
 */

 namespace App\Models;

 use \App\Persistence\Conexao as Conexao;

 class ProdutoModel  {
    
    protected  $con;
    protected \App\Entities\Produto $entity;
    
    public function __construct() {
        $this->con = Conexao::getInstance();
    }

    public function getAll(){
        $sql = 'SELECT * FROM produtos ';
        $query = $this->con->query($sql, \PDO::FETCH_OBJ);

        $data = [];
        foreach( $query->fetchAll() as $row ) { 
             $data[] = $row;
        }
        
        return $data;
    }

    public function add(\App\Entities\Produto $entity): bool{

        //die(var_dump($entity));

        $sql  = ' INSERT INTO produtos (descricao, valor_unitario) ';
        $sql .= ' VALUES(?,? ) ' ;

        $stm = $this->con->prepare($sql);

        //$stm->bindValue(1, $entity->getId());
        $stm->bindValue(1, $entity->getDescricao());
        $stm->bindValue(2, $entity->getValorUnitario());

        $inserted = $stm->execute();

        die(var_dump($inserted));

        // return [
        //     'success' => $inserted,
        //     'data' => [],
        //     'message' => $inserted ? 'registro salvo com sucesso' : 'não foi possível incluir o registro'
        // ];

        return $inserted;
    }

    public function update(\App\Entities\Produto $entity): bool{
           //die(var_dump($entity));

           $sql  = ' UPDATE produtos                             
                            SET descricao = ? , 
                            valorUnitario = ? ';

           $sql .= ' WHERE id = ? ' ;
              
           $stm = $this->con->prepare($sql);
   
           $stm->bindValue(1, $entity->getDescricao());
           $stm->bindValue(2, $entity->getValorUnitario());
           $stm->bindValue(3, $entity->getId());
   
           $updated = $stm->execute();
   
           //die(var_dump($inserted));
   
        //    return [
        //        'success' => $updated,
        //        'data' => [],
        //        'message' => $update ? 'registro salvo com sucesso' : 'não foi possível incluir o registro'
        //    ];
   
           return $updated;
    }

    public function delete($id){
        $sql  = ' DELETE FROM produtos '; 
        $sql .= ' WHERE id = ? ' ;

        $stm = $this->con->prepare($sql);
        $stm->bindValue(1, $id);

        $deleted = $stm->execute();


         return json_encode([
               'success' => $deleted,
               'data' => [],
               'message' => $deleted ? 'produto excluído com sucesso' : 'não foi possível excluir o produto'
           ]);

        //return $updated;      
    } 

 }