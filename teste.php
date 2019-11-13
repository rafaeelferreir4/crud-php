<?php 
    include_once('curso.php');
    include_once('cursoDAO.php');
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

?>