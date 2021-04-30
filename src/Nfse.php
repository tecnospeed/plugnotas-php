<?php
namespace TecnoSpeed\Plugnotas;

use FerFabricio\Hydrator\Hydrate;
use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Communication\CallApi;
use TecnoSpeed\Plugnotas\Configuration;
use TecnoSpeed\Plugnotas\Error\RequiredError;
use TecnoSpeed\Plugnotas\Error\ValidationError;
use TecnoSpeed\Plugnotas\Interfaces\IDfe;
use TecnoSpeed\Plugnotas\Nfse\CidadePrestacao;
use TecnoSpeed\Plugnotas\Nfse\Impressao;
use TecnoSpeed\Plugnotas\Nfse\Prestador;
use TecnoSpeed\Plugnotas\Nfse\Rps;
use TecnoSpeed\Plugnotas\Nfse\Servico;
use TecnoSpeed\Plugnotas\Nfse\CargaTributaria;
use TecnoSpeed\Plugnotas\Nfse\Tomador;
use TecnoSpeed\Plugnotas\Nfse\Intermediario;
use TecnoSpeed\Plugnotas\Nfse\CamposExtras;
use TecnoSpeed\Plugnotas\Nfse\Parcelas;
use TecnoSpeed\Plugnotas\Traits\Communication;


class Nfse extends BuilderAbstract implements IDfe
{
    use Communication;

    private $cidadePrestacao;
    private $configuration;
    private $enviarEmail;
    private $idIntegracao;
    private $impressao;
    private $prestador;
    private $rps;
    private $servico;
    private $substituicao;
    private $tomador;
    private $intermediario;
    private $naturezaTributacao;
    private $idNotaSubstituida;
    private $cargaTributaria;
    private $descricao;
    private $camposExtras;
    private $parcelas;
    private $informacoesComplementares;
    private $ativo;


    public function setCidadePrestacao(CidadePrestacao $cidadePrestacao)
    {
        $this->cidadePrestacao = $cidadePrestacao;
    }

    public function getCidadePrestacao()
    {
        return $this->cidadePrestacao;
    }

    public function setConfiguration(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration()
    {
        return $this->configuration;
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

    public function setNaturezaTributacao($naturezaTributacao)
    {
        if (!v::in([1,2,3,4,5,6])->validate($naturezaTributacao)) {
            throw new ValidationError(
                'Tipo de Natureza da Tributação inválido.'
            );
        }
        $this->naturezaTributacao = $naturezaTributacao;
    }

    public function getNaturezaTributacao()
    {
        return $this->naturezaTributacao;
    }
    public function setImpressao(Impressao $impressao)
    {
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

    public function setServico(array $servicos)
    {
        $this->servico = $servicos;
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

    public function setIntermediario(Intermediario $intermediario)
    {
        $this->intermediario = $intermediario;
    }

    public function getIntermediario()
    {
        return $this->intermediario;
    }

    public function setIdNotaSubstituida($idNotaSubstituida)
    {
        $this->idNotaSubstituida = $idNotaSubstituida;
    }

    public function getIdNotaSubstituida()
    {
        return $this->idNotaSubstituida;
    }

    public function setCargaTributaria(CargaTributaria $cargaTributaria)
    {
        $this->cargaTributaria = $cargaTributaria;
    }

    public function getCargaTributaria()
    {
        return $this->cargaTributaria;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setCamposExtras(CamposExtras $camposExtras)
    {
        $this->camposExtras = $camposExtras;
    }

    public function getCamposExtras()
    {
        return $this->camposExtras;
    }

    public function setInformacoesComplementares($informacoesComplementares)
    {
        $this->informacoesComplementares = $informacoesComplementares;
    }

    public function getInformacoesComplementares()
    {
        return $this->informacoesComplementares;
    }

    public function setParcelas(Parcelas $parcelas)
    {
        $this->parcelas = $parcelas;
    }

    public function getParcelas()
    {
        return $this->parcelas;
    }
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function validate()
    {
        $data = $this->toArray();

        $validateHasPrestadorCpfCnpj = v::allOf(
            v::keyNested('prestador.cpfCnpj')
        )->validate($data);
        $validateArrayServices = $this->validateArrayServices($data['servico']);

        $validateData = $validateHasPrestadorCpfCnpj && $validateArrayServices;

        if(!$validateData) {
            throw new RequiredError(
                'Os parâmetros mínimos para criar uma Nfse não foram preenchidos.'
            );
        }

        return true;
    }

    private function validateArrayServices($servico): bool
    {
        $validateServices = v::arrayVal()->each(
            v::oneOf(
                v::allOf(
                    v::keyNested('codigo'),
                    v::keyNested('discriminacao'),
                    v::keyNested('cnae'),
                    v::keyNested('iss.aliquota'),
                    v::keyNested('valor.servico')
                ),
                v::allOf(
                    v::keyNested('id')
                )
            )
        )->validate($servico);

        return $validateServices;
    }

  public function send($configuration = null)
    {
        $this->validate();

        if ($configuration) {
            $this->setConfiguration($configuration);
        }

        $communication = $this->getCallApiInstance($this->configuration);
        return $communication->send('POST', '/nfse', [$this->toArray(true)]);
    }

    public static function fromArray($data)
    {
        if (array_key_exists('prestador', $data)) {
            $data['prestador'] = Prestador::fromArray($data['prestador']);
        }

        if (array_key_exists('servico', $data)) {
            $data['servico'] = Servico::fromArray($data['servico']);
        }

        if (array_key_exists('tomador', $data)) {
            $data['tomador'] = Tomador::fromArray($data['tomador']);
        }

        if (array_key_exists('rps', $data)) {
            $data['rps'] = Rps::fromArray($data['rps']);
        }

        if (array_key_exists('cidadePrestacao', $data)) {
            $data['cidadePrestacao'] = CidadePrestacao::fromArray($data['cidadePrestacao']);
        }

        if (array_key_exists('impressao', $data)) {
            $data['impressao'] = Impressao::fromArray($data['impressao']);
        }

        if (array_key_exists('intermediario', $data)) {
            $data['intermediario'] = Intermediario::fromArray($data['intermediario']);
        }

        if (array_key_exists('cargaTributaria', $data)) {
            $data['cargaTributaria'] = CargaTributaria::fromArray($data['cargaTributaria']);
        }

        if (array_key_exists('camposExtras', $data)) {
            $data['camposExtras'] = CamposExtras::fromArray($data['camposExtras']);
        }

        if (array_key_exists('parcelas', $data)) {
            $data['parcelas'] = Parcelas::fromArray($data['parcelas']);
        }

        return Hydrate::toObject(Nfse::class, $data);
    }

    public function find($id)
    {
        $communication = $this->getCallApiInstance($this->configuration);
        return $communication->send('GET', "/nfse/${id}", null);
    }

    public function findByCnpjAndIdIntegracao($cnpj, $idIntegracao)
    {
        $communication = $this->getCallApiInstance($this->configuration);
        return $communication->send('GET', "/nfse/consultar/${idIntegracao}/${cnpj}", null);
    }

    public function findByIdOrProtocol($idOrProtocol)
    {
        $communication = $this->getCallApiInstance($this->configuration);
        return $communication->send('GET', "/nfse/consultar/${idOrProtocol}", null);
    }

    public function findCancel($id)
    {
        $communication = $this->getCallApiInstance($this->configuration);
        return $communication->send('GET', "/nfse/cancelar/status/${id}", null);
    }

    public function download($id)
    {
        return $this->downloadXml($id);
    }

    public function downloadPdf($id)
    {
        $communication = $this->getCallApiInstance($this->configuration);
        if (!$this->configuration->getNfseDownloadDirectory()) {
            throw new RequiredError('É necessário setar o diretório para download do PDF.');
        }

        return $communication->download(
            'GET',
            "/nfse/pdf/${id}",
            null,
            $this->configuration->getNfseDownloadDirectory() . '/' . $id . '.pdf'
        );
    }

    public function downloadPdfByCnpjAndIdIntegracao($cnpj, $idIntegracao)
    {
        $communication = $this->getCallApiInstance($this->configuration);

        if (!$this->configuration->getNfseDownloadDirectory()) {
            throw new RequiredError('É necessário setar o diretório para download do PDF.');
        }

        return $communication->download(
            'GET',
            "/nfse/pdf/${idIntegracao}/${cnpj}",
            null,
            $this->configuration->getNfseDownloadDirectory() . '/' . $cnpj . '-' . $idIntegracao . '.pdf'
        );
    }

    public function downloadXml($id)
    {
        $communication = $this->getCallApiInstance($this->configuration);
        if (!$this->configuration->getNfseDownloadDirectory()) {
            throw new RequiredError('É necessário setar o diretório para download do XML.');
        }

        return $communication->download(
            'GET',
            "/nfse/xml/${id}",
            null,
            $this->configuration->getNfseDownloadDirectory() . '/' . $id . '.xml'
        );
    }

    public function downloadXmlByCnpjAndIdIntegracao($cnpj, $idIntegracao)
    {
        $communication = $this->getCallApiInstance($this->configuration);

        if (!$this->configuration->getNfseDownloadDirectory()) {
            throw new RequiredError('É necessário setar o diretório para download do XML.');
        }

        return $communication->download(
            'GET',
            "/nfse/xml/${idIntegracao}/${cnpj}",
            null,
            $this->configuration->getNfseDownloadDirectory() . '/' . $cnpj . '-' . $idIntegracao . '.xml'
        );
    }

    public function cancel($id)
    {
        $communication = $this->getCallApiInstance($this->configuration);
        return $communication->send('POST', "/nfse/cancelar/${id}", null);
    }

    public function cancelByCnpjAndIdIntegracao($cnpj, $idIntegracao)
    {
        $communication = $this->getCallApiInstance($this->configuration);
        return $communication->send('POST', "/nfse/cancelar/${idIntegracao}/${cnpj}", null);
    }

    public function cancelStatus($id)
    {
        $communication = $this->getCallApiInstance($this->configuration);
        return $communication->send('GET', "/nfse/cancelar/status/${id}", null);
    }
}
