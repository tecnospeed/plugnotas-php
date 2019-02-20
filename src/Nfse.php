<?php
namespace TecnoSpeed\Plugnotas;

use FerFabricio\Hydratate\Hydratate;
use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Interfaces\IDfe;
use TecnoSpeed\Plugnotas\Nfse\CidadePrestacao;
use TecnoSpeed\Plugnotas\Nfse\Prestador;
use TecnoSpeed\Plugnotas\Nfse\Rps;
use TecnoSpeed\Plugnotas\Nfse\Servico;
use TecnoSpeed\Plugnotas\Nfse\Tomador;

class Nfse implements IDfe
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

    public function validate()
    {
        
    }

    public static function fromArray($items)
    {
        if (array_key_exists('prestador', $items)) {
            $prestador = Prestador::fromArray($items['prestador']);
            unset($items['prestador']);
        }

        if (array_key_exists('servico', $items)) {
            $servico = Servico::fromArray($items['servico']);
            unset($items['servico']);
        }

        if (array_key_exists('tomador', $items)) {
            $tomador = Tomador::fromArray($items['tomador']);
            unset($items['tomador']);
        }

        if (array_key_exists('rps', $items)) {
            $rps = Rps::fromArray($items['rps']);
            unset($items['rps']);
        }

        if (array_key_exists('cidadePrestacao', $items)) {
            $cidadePrestacao = CidadePrestacao::fromArray($items['cidadePrestacao']);
            unset($items['cidadePrestacao']);
        }

        $resultObject = Hydratate::toObject(Nfse::class, $items);

        if (isset($rps)) {
            $resultObject->setRps($rps);
        }

        if (isset($cidadePrestacao)) {
            $resultObject->setCidadePrestacao($cidadePrestacao);
        }

        if (isset($prestador)) {
            $resultObject->setPrestador($prestador);
        }

        if (isset($servico)) {
            $resultObject->setServico($servico);
        }

        if (isset($tomador)) {
            $resultObject->setTomador($tomador);
        }

        return $resultObject;
    }
}
