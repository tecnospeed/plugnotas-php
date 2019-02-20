<?php
namespace TecnoSpeed\Plugnotas;

use FerFabricio\Hydratate\Hydratate;
use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Interfaces\IBuilder;
use TecnoSpeed\Plugnotas\Nfse\CidadePrestacao;
use TecnoSpeed\Plugnotas\Nfse\Prestador;
use TecnoSpeed\Plugnotas\Nfse\Rps;
use TecnoSpeed\Plugnotas\Nfse\Servico;
use TecnoSpeed\Plugnotas\Nfse\Tomador;

class Nfse implements Ibuilder
{
    private $cidadePrestacao;
    private $enviarEmail;
    private $idIntegracao;
    private $impressao;
    private $prestador;
    private $rps;
    private $servico;
    private $substituicao;
    private $tomador;

    public function setCidadePrestacao(CidadePrestacao $cidadePrestacao)
    {
        $this->cidadePrestacao = $cidadePrestacao;
    }

    public function getCidadePrestacao()
    {
        return $this->cidadePrestacao;
    }

    public function setEnviarEmail($enviarEmail)
    {
        if (!v::boolVal()->validate($enviarEmail)) {
            throw new ValidationError('enviarEmail deve ser um valor booleano.');
        }
        $this->enviarEmail = $enviarEmail;
    }

    public function getEnviarEmail()
    {
        return $this->enviarEmail;
    }

    public function setIdIntegracao($idIntegracao)
    {
        $this->idIntegracao = $idIntegracao;
    }

    public function getIdIntegracao()
    {
        return $this->idIntegracao;
    }

    public function setImpressao($impressao)
    {
        if (!v::arrayVal()->validate($impressao)) {
            throw new ValidationError('Impressão deve ser um array.');
        }
        $this->impressao = $impressao;
    }

    public function getImpressao()
    {
        return $this->impressao;
    }

    public function setPrestador(Prestador $prestador)
    {
        $this->prestador = $prestador;
    }

    public function getPrestador()
    {
        return $this->prestador;
    }

    public function setRps(Rps $rps)
    {
        $this->rps = $rps;
    }

    public function getRps()
    {
        return $this->rps;
    }

    public function setServico(Servico $servico)
    {
        $this->servico = $servico;
    }

    public function getServico()
    {
        return $this->servico;
    }

    public function setSubstituicao($substituicao)
    {
        if (!v::boolVal()->validate($substituicao)) {
            throw new ValidationError('Substituicao deve ser um valor booleano.');
        }
        $this->substituicao = $substituicao;
    }

    public function getSubstituicao()
    {
        return $this->substituicao;
    }

    public function setTomador(Tomador $tomador)
    {
        $this->tomador = $tomador;
    }

    public function getTomador()
    {
        return $this->tomador;
    }

    public static function fromArray($items)
    {
        $resultObject = new self::class;
        if (array_key_exists('rps', $items)) {
            $rps = Rps::fromArray($items['rps']);
        }
    }
}
