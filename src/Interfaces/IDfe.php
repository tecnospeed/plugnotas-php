<?php

namespace TecnoSpeed\Plugnotas\Interfaces;

use TecnoSpeed\Plugnotas\Configuration;

interface IDfe
{
    public function downloadPdf($id);
    public function downloadPdfByCnpjAndIdIntegracao($cnpj, $idIntegracao);
    public function find($id);
    public function findByCnpjAndIdIntegracao($cnpj, $idIntegracao);
    public function findByIdOrProtocol($idOrProtocol);
    public function send(Configuration $configuration);
    public function toArray();
    public function validate();
    public static function fromArray($items);
}
