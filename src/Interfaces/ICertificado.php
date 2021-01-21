<?php

namespace TecnoSpeed\Plugnotas\Interfaces;

interface ICertificado
{
    public function get();
    public function create($configuration = null);
    public function update($idCertificado, $configuration = null);
    public function toArray();
    public function validate();
}
