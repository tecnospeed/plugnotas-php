[![Build Status](https://travis-ci.org/tecnospeed/plugnotas-php.svg?branch=master)](https://travis-ci.org/tecnospeed/plugnotas-php) [![codecov](https://codecov.io/gh/tecnospeed/plugnotas-php/branch/master/graph/badge.svg)](https://codecov.io/gh/tecnospeed/plugnotas-php)
# Plugnotas

Este pacote foi construído com o objetivo de simplificar a integração com a API do [Plugnotas](https://plugnotas.com.br).
Para obter informações sobre o funcionamento e contratações acesse [nosso site](https://plugnotas.com.br) ou a [documentação oficial](https://atendimento.tecnospeed.com.br/hc/pt-br/categories/360001354313-Plugnotas).

## Instalação

### Adicionando o pacote

Aconselhamos a instalação do pacote pelo [Composer](https://getcomposer.org). Composer é um gerenciador de dependências para PHP que lhe permite declarar e instalar as dependências em seu projeto de forma simplificada.

O pacote pode ser adicionado utilizando o comando do próprio composer:

```
php composer.phar require tecnospeedsa/plugnotas:~1.0
```

Ou adicionado manualmente no arquivo `composer.json`:

```
{
  "require": {
    "tecnospeedsa\plugnotas": "~1.0"
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

* [Cadastro de Prestador](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.prestador.create.php)
* [Cadastro de Tomador](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.tomador.create.php)
* [Cadastro de Serviço](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.servico.create.php)

### Exemplos

Você pode conferir alguns exemplos na pasta `/examples`.

[Todos os objetos decompostos em arrays podem ser vistos no arquivo nfse.array.php](https://github.com/tecnospeed/plugnotas-php/blob/master/examples/nfse.array.php).

## Documentações oficiais
- [Site do Plugnotas](https://plugnotas.com.br/)
- [Documentação oficial](https://atendimento.tecnospeed.com.br/hc/pt-br/categories/360001354313-Plugnotas)
- [Documentação da API](https://docs.plugnotas.com.br/)

## Changelog
Acesse o [Changelog da aplicação por este link](https://github.com/tecnospeed/plugnotas-php/blob/master/CHANGELOG.md).
