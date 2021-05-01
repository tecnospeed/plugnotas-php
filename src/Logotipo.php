<?php
namespace TecnoSpeed\Plugnotas;

use TecnoSpeed\Plugnotas\Abstracts\BuilderAbstract;
use TecnoSpeed\Plugnotas\Interfaces\ILogotipo;
use TecnoSpeed\Plugnotas\Communication\CallApi;
use TecnoSpeed\Plugnotas\Traits\Communication;
use TecnoSpeed\Plugnotas\Configuration;

class Logotipo extends BuilderAbstract implements ILogotipo
{
    use Communication;

    private $file;

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

    public function create($cnpj, Configuration $configuration)
    {
        $communication = $this->getCallApiInstance($configuration);
        return $communication->sendWithFiles('POST', "/empresa/${cnpj}/logotipo", $this->toArray());
    }
}
