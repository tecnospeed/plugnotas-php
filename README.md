[![Build Status](https://travis-ci.org/tecnospeed/plugnotas-php.svg?branch=master)](https://travis-ci.org/tecnospeed/plugnotas-php) [![codecov](https://codecov.io/gh/tecnospeed/plugnotas-php/branch/master/graph/badge.svg)](https://codecov.io/gh/tecnospeed/plugnotas-php)

# Plugnotas

Este pacote foi construído com o objetivo de simplificar a integração com a API do [Plugnotas](https://plugnotas.com.br).
Para obter informações sobre o funcionamento e contratações acesse [nosso site](https://plugnotas.com.br) ou a [documentação oficial](https://atendimento.tecnospeed.com.br/hc/pt-br/categories/360001354313-Plugnotas).

## Instalação

### Adicionando o pacote

Aconselhamos a instalação do pacote pelo [Composer](https://getcomposer.org). Composer é um gerenciador de dependências para PHP que lhe permite declarar e instalar as dependências em seu projeto de forma simplificada.

O pacote pode ser adicionado utilizando o comando do próprio composer:

```
php composer.phar require tecnospeedsa/plugnotas:~1.4
```

Ou adicionado manualmente no arquivo `composer.json`:

```
{
  "require": {
    "tecnospeedsa/plugnotas": "~1.4"
  }
}
```

O carregamento do pacote é realizado com o autoloader do Composer, caso você não tenha adicionado ao seu projeto é necessário incluir o seguinte require:

```
require 'vendor/autoload.php;'
```

Para maiores informações de como instalar, utilizar e melhores práticas para definir dependências em seu projeto acesse o site oficial [getcomposer.org](https://getcomposer.org).

## Utilizando o pacote

### Envio de NFSe

Para enviar uma NFSe deve ser criado um objeto do tipo relacionado (`TecnoSpeed\Plugnotas\Nfse`), o qual é composto de vários outros objetos agrupados dentro de seu namespace.

Uma vez o objeto criado deve-se chamar o método `send` do mesmo, este processo pode ser bem complexo e extenso, não se preocupe existe uma forma mais fácil citada a seguir.

Um exemplo do [envio de uma NFSe criando os objetos de forma manual pode ser encontrado aqui](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.full.php).

### Criando uma NFSe com o auxiliar de builder

A classe `TecnoSpeed\Plugnotas\Builders\NfseBuilder` é uma classe auxiliar que permite você criar de forma fácil um objeto `TecnoSpeed\Plugnotas\Nfse`.

Com esta classe auxiliar utilizando os métodos: `withTomador`, `withPrestador`, `withServico`, `withRps`, `withImpressao` e `withCidadePrestacao` você pode compor o objeto Nfse, [um exemplo disso é mostrado no arquivo nfse.simple.php](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.simple.php).

### Cadastro de Prestador, Tomador e Serviço

O cadastro de Prestador, Tomador e Serviço simplifica o envio da NFSe, sendo que uma vez cadastrado você pode enviar a nota com menos parâmetros pois o que já tem cadastrado será consultado.

Nos links a seguir você encontra exemplos dos cadastros dos tipos:

- [Cadastro de Prestador](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.prestador.create.php)
- [Cadastro de Tomador](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.tomador.create.php)
- [Cadastro de Serviço](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.servico.create.php)

### Consultando uma NFSe

Para consultar uma NFSe é necessário criar um objeto do tipo `TecnoSpeed\Plugnotas\Configuration`, setar ele num novo objeto `TecnoSpeed\Plugnotas\Nfse` utilizando o método `setConfiguration`.

Após este setup realizado, existe duas possibilidades de consulta, pelo ID da nota ou protocolo gerado na hora que você enviou a nota, ou passando o ID Integração e o CNPJ do Prestador utilizado para criar a NFSe. Os respectivos métodos são: `findByCnpjAndIdIntegracao` e `findByIdOrProtocol`.

Exemplo utilizando o [método findByCnpjAndIdIntegracao pode ser encontrado aqui](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.consulta.cnpjId.php) e [exemplo utilizando o método findByIdOrProtocol pode ser encontrado aqui](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.consulta.cnpjId.php).

### Download do PDF de uma NFSe

Da mesma forma que a consulta o download do PDF da Nfse necessita de um objeto do tipo `TecnoSpeed\Plugnotas\Configuration`, o qual deve ser setado num novo objeto `TecnoSpeed\Plugnotas\Nfse` utilizando o método `setConfiguration`.
Uma particularidade é que é necessário indicar a pasta para escrita dos arquivos no objeto de configuração utilizando o método `setNfseDownloadDirectory`.

Existe a possibilidade de realizar o download utilizando o ID da nota retornado na criação utilizando o método `download`, como também realizar o download utilizando o CNPJ do Prestador e o ID Integração utilizados no envio da NFSe através do método `downloadPdfByCnpjAndIdIntegracao`.

Os arquivos serão salvos na pasta configurada (a qual precisa ter permissão de escrita), o padrão do nome do arquivo será o seguinte:

- Quando utilizado o método `download`: `<pasta informada>/<id>.pdf`
- Quando utilizado o método `downloadPdfByCnpjAndIdIntegracao`: `<pasta informada>/<cnpj>-<id integração>.pdf`

[Exemplo de download utilizando o ID pode ser encontrado aqui](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.download.php) e [exemplo de download utilizando o CNPJ e ID Integração aqui](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.download.cnpjId.php).

### Cancelamento

O cancelamento de uma NFSe pode ser realizado da mesma forma com que a busca e o download, informando o ID da Nfse ou o Cnpj do prestador e o ID Integração.

Da mesma forma que a consulta e o download do PDF da Nfse é necessário de um objeto do tipo `TecnoSpeed\Plugnotas\Configuration`, o qual deve ser setado num novo objeto `TecnoSpeed\Plugnotas\Nfse` utilizando o método `setConfiguration`.

Os respectivos métodos para realizar este procedimento são: `cancel` e `cancelByCnpjAndIdIntegracao`.

Ao criar um cancelamento será retornado um protocolo, tal protocolo pode ser utilizado para consultar o status do cancelamento utilizando a rota `cancelStatus`.

### Exemplos

Você pode conferir alguns exemplos na pasta `/examples`.

[Todos os objetos decompostos em arrays podem ser vistos no arquivo nfse.array.php](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.array.php).

## Documentações oficiais

- [Site do Plugnotas](https://plugnotas.com.br/)
- [Documentação oficial](https://atendimento.tecnospeed.com.br/hc/pt-br/categories/360001354313-Plugnotas)
- [Documentação da API](https://docs.plugnotas.com.br/)

## Changelog

Acesse o [Changelog da aplicação por este link](https://github.com/tecnospeed/plugnotas-php/blob/master/CHANGELOG.md).
