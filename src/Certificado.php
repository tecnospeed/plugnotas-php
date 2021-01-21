<?php
namespace TecnoSpeed\Plugnotas;

use Respect\Validation\Validator as v;
use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Interfaces\ICertificado;
use TecnoSpeed\Plugnotas\Communication\CallApi;
use TecnoSpeed\Plugnotas\Traits\Communication;
use TecnoSpeed\Plugnotas\Error\RequiredError;

use __ as Bottomline;

class Certificado extends BuilderAbstract implements ICertificado
{
    use Communication;

    private $configuration;
    private $file;
    private $fileNameWithExtension;
    private $password;

    public function toArray($excludeNull = true)
    {
        $vars = get_object_vars($this);
        $array = array();
        foreach ($vars as $key => $value) {
            $array[ltrim($key, '_')] = $value;
        }

        return Bottomline::pick($array, ['password', 'file']);
    }

    public function setFile($file, $fileNameWithExtension)
    {
        $splFileObject = new \SplFileInfo($file);

        $this->file = [
            'name' => 'arquivo',
            'contents' => file_get_contents($splFileObject->getPathName()),
            'filename' => $fileNameWithExtension
        ];
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setPassword($password)
    {
        $this->password = [
            'name' => 'senha',
            'contents' => $password,
        ];
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setConfiguration(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }

    public function get()
    {
        $communication = $this->getCallApiInstance($this->configuration);
        return $communication->send('GET', "/certificado", null);
    }

    public function validate()
    {
        $data = $this->toArray();
        if(
            !v::allOf(
                v::keyNested('file'),
                v::keyNested('password')
            )->validate($data)
        ) {
            throw new RequiredError(
                'Os parâmetros mínimos para cadastrar um Certificado não foram preenchidos.'
            );
        }

        return true;
    }

    public function create($configuration = null)
    {
        $this->validate();

        if ($configuration) {
            $this->setConfiguration($configuration);
        }

        $communication = $this->getCallApiInstance($this->configuration);
        return $communication->sendWithFiles('POST', '/certificado', $this->toArray());
    }

    public function update($idCertificado, $configuration = null)
    {
        $this->validate();

        if($configuration) {
            $this->setConfiguration($configuration);
        }

        $communication = $this->getCallApiInstance($this->configuration);
        return $communication->sendWithFiles('PUT', "/certificado/${idCertificado}", $this->toArray());
    }
}
