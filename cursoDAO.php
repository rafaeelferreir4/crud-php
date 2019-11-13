<?php
include_once('curso.php');
    class CursoDAO {
        private function getConexao () {
            $con = new PDO("pgsql:host=localhost; dbname=academico; port=5432", "postgres", "postgres"); 
            return $con;
        }
        public function inserir ($curso) {
            $con = $this->getConexao();
            $sql = 'INSERT INTO "Curso" (nome, area, "cargaHoraria", "dataFundacao") values (?, ?, ?, ?)';
            
            $stm = $con->prepare($sql);
            
            $stm->bindValue(1, $curso->getNome());
            $stm->bindValue(2, $curso->getArea());
            $stm->bindValue(3, $curso->getCargaHoraria());
            $stm->bindValue(4, $curso->getDataFundacao());

            $res = $stm->execute();
            $stm->closeCursor();
            $stm = NULL;
            $con = NULL;
            return $res;
        }
        public function excluir ($id) {
            $con = $this->getConexao();
            $sql = 'DELETE FROM "Curso" WHERE id = ?';

            $stm = $con->prepare($sql);
            $stm->bindValue(1,$id);
            
            $res = $stm->execute();
            
            $stm->closeCursor();
            $stm = NULL;
            $con = NULL;
            
            return $res;
        }
        public function buscar ($id) {
            $con = $this->getConexao();
            $sql = 'SELECT * FROM "Curso" WHERE id = ?';
            
            $stm = $con->prepare($sql);
            $stm->bindValue(1,$id);

            $res = $stm->execute();

            $result = $stm->fetch(PDO::FETCH_ASSOC);
            $curso = new Curso($result['nome'], $result['area'], $result['cargaHoraria'], $result['dataFundacao']);
            $curso->setId(intval($result['id']));

            return $curso;
        }
        public function listar($limit, $offset){
		$con = $this->getConexao();
		$sql = 'SELECT * FROM "Curso" LIMIT ? OFFSET ?';
        
        $stm = $con->prepare($sql);
		$stm->bindValue(1,$limit);
		$stm->bindValue(2,$offset);
        
        $res = $stm->execute();
        $listcurso = array();
        if ($res) {
            while($result = $stm->fetch(PDO::FETCH_ASSOC)){
                $curso = new Curso($result['nome'], $result['area'], $result['cargaHoraria'], $result['dataFundacao']);
                $curso->setId(intval($result['id']));
                array_push($listcurso,$curso);
            }
        } else {
            return false;
        }
		
		$stm->closeCursor();
		$stm=NULL;
		$con = NULL;
		return $listcurso;
	}
    public function altera ($curso){
            $con = $this->getConexao();
            $sql='UPDATE "Curso" SET "nome" = ?, "area" = ?, "cargaHoraria" = ?, "dataFundacao" = ? WHERE "id" = ? ';
            $stm = $con->prepare($sql);
            $stm->bindValue(1,$curso->getNome());
            $stm->bindValue(2,$curso->getArea());
            $stm->bindValue(3,$curso->getCargaHoraria());
            $stm->bindValue(4,$curso->getDataFundacao());
            $stm->bindValue(5,$curso->getId(), PDO::PARAM_INT);
            $res = $stm->execute();
            $stm->closeCursor();
            $stm = NULL;
            $con = NULL;
            return $res;
        }
        public function salva ($curso, $method) {
            if ($method === 'altera') {
                return $this->altera ($curso);
            } else {
                return $this->inserir ($curso);
            }
        }
    }
    $cdao = new CursoDAO();
    $curso = new Curso('info', 'ti', 20, '2019-10-11');
    $curso2 = new Curso('geo', 'mapa', 29, '2015-10-11');
    $curso3 = new Curso('eletro', 'eletrica', 2, '2017-10-11');
    $cdao->inserir($curso);
    $cdao->inserir($curso2);
    $cdao->inserir($curso3);
    $cdao->excluir(1);
    var_dump ($cdao->buscar(2));
    var_dump( $cdao->listar(2,1));
    // 



?>