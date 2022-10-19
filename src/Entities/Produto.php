<?php
/**
 * Model produto
 * @author Wanderlei Silva do Carmo <wander.silva@gmail.com>
 * @version 0.1
 * 
 */

 //Entity Produto
 namespace App\Entities;

 class Produto {

    private int $id;
    private string $descricao;
    private float $valorUnitario;

    /**
     * Get the value of id
     */ 
    public function getId(){
        
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){

        $this->id = $id;
        
    }

    

    /**
     * Get the value of nome
     */ 
    public function getDescricao(){

        return $this->descricao;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setDescricao($descricao){

        $this->descricao = $descricao;
        
    }

    

    /**
     * Get the value of valorUnitario
     */ 
    public function getValorUnitario(){

        return $this->valorUnitario;
    }

    /**
     * Set the value of valorUnitario
     *
     * @return  self
     */ 
    public function setValorUnitario($valorUnitario){

        $this->valorUnitario = $valorUnitario;
    
    }
 }