<?php
namespace TecnoSpeed\Plugnotas\Nfse;

use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;

class CargaTributaria extends BuilderAbstract
{
    private $valor;
    private $percentual;
    private $fonte;

public function setValor($valor){
    
    $this->valor = (float)$valor;
}

public function getValor()
{
    return $this->valor;
}

public function setPercentual($percentual){

    $this->percentual = $percentual;
}

public function getPercentual()
{
    return $this->percentual;
}

public function setFonte($fonte){
   
    $this->fonte = $fonte;
}

public function getFonte()
{
    return $this->fonte;
}
}
?>

