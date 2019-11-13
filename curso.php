<?php
    class Curso {
        private $id;
        private $nome;
        private $area;
        private $cargaHoraria;
        private $dataFundacao;
        public function __construct ($nome, $area, $cargahoraria, $datafundacao) {
            $this->nome = $nome;
            $this->area = $area;
            $this->cargaHoraria = $cargahoraria;
            $this->dataFundacao = $datafundacao;
        }
        public function getId(){
            return $this->id;
        }
        public function getNome () {
            return $this->nome;
        }
        public function getArea () {
            return $this->area;
        }
        public function getCargaHoraria () {
            return $this->cargaHoraria;
        }
        public function getDataFundacao () {
            return $this->dataFundacao;
        }
        public function setId($newId){
            $this->id = $newId;
        }
        public function setNome ($newNome) {
            $this->nome = $newNome;
        }
        public function setArea ($newArea) {
            $this->area = $newArea;
        }
        public function setCargaHoraria ($newCargaH) {
            $this->cargaHoraria = $newCargaH;
        }
        public function setDataFundacao ($newData) {
            $this->dataFundacao = new DateTime($newData);
        } 
    }
?>