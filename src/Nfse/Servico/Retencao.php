<?php

namespace TecnoSpeed\Plugnotas\Nfse\Servico;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Common\ValorAliquota;
use TecnoSpeed\Plugnotas\Common\PisCofinsValorAliquota;
use TecnoSpeed\Plugnotas\Error\ValidationError;

class Retencao extends BuilderAbstract
{
    private $cofins;
    private $csll;
    private $inss;
    private $irrf;
    private $outrasRetencoes;
    private $pis;
    private $cpp;

    public function setCofins(PisCofinsValorAliquota $cofins)
    {
        $this->cofins = $cofins;
    }

    public function getCofins()
    {
        return $this->cofins;
    }

    public function setCsll(ValorAliquota $csll)
    {
        $this->csll = $csll;
    }

    public function getCsll()
    {
        return $this->csll;
    }

    public function setInss(ValorAliquota $inss)
    {
        $this->inss = $inss;
    }

    public function getInss()
    {
        return $this->inss;
    }

    public function setIrrf(ValorAliquota $irrf)
    {
        $this->irrf = $irrf;
    }

    public function getIrrf()
    {
        return $this->irrf;
    }

    public function setOutrasRetencoes($outrasRetencoes)
    {
        $this->outrasRetencoes = $outrasRetencoes;
    }

    public function getOutrasRetencoes()
    {
        return $this->outrasRetencoes;
    }

    public function setPis(PisCofinsValorAliquota $pis)
    {
        $this->pis = $pis;
    }

    public function getPis()
    {
        return $this->pis;
    }
    public function setCpp(ValorAliquota $cpp)
    {
        $this->cpp = $cpp;
    }

    public function getCpp()
    {
        return $this->cpp;
    }
    public static function fromArray($data)
    {
        $retencao = new Retencao();

        foreach ($data as $key => $value) {
            if ($key == 'outrasRetencoes') {
                $retencao->setOutrasRetencoes($value);
                continue;
            }

            $retencao->{'set' . ucfirst($key)}(ValorAliquota::fromArray($value));
        }

        return $retencao;
    }
}
