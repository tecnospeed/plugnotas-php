# Plugnotas

Este pacote foi construído com o objetivo de simplificar a integração com a API do [Plugnotas](https://plugnotas.com.br).
Para obter informações sobre o funcionamento e contratações acesse [nosso site](https://plugnotas.com.br) ou a [documentação oficial](https://atendimento.tecnospeed.com.br/hc/pt-br/categories/360001354313-Plugnotas).

## Instalação

### Adicionando o pacote

Aconselhamos a instalação do pacote pelo [Composer](https://getcomposer.org). Composer é um gerenciador de dependências para PHP que lhe permite declarar e instalar as dependências em seu projeto de forma simplificada.

O pacote pode ser adicionado utilizando o comando do próprio composer:

```
php composer.phar require tecnospeed/plugnotas:~1.0
```

Ou adicionado manualmente no arquivo `composer.json`:

```
{
  "require": {
    "tecnospeed\plugnotas": "~1.0"
  }
}
```

O carregamento do pacote é realizado com o autoloader do Composer, caso você não tenha adicionado ao seu projeto é necessário incluir o seguinte require:

```
require 'vendor/autoload.php;'
```

Para maiores informações de como instalar, utilizar e melhores práticas para definir dependências em seu projeto acesse o site oficial [getcomposer.org](https://getcomposer.org).

## Documentações oficiais

- [Documentação oficial](https://atendimento.tecnospeed.com.br/hc/pt-br/categories/360001354313-Plugnotas)
- [Documentação da API](https://docs.plugnotas.com.br/)

## Changelog
Acesse o [Changelog da aplicação por este link](CHANGELOG.md).
