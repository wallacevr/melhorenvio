# Shipment SDK - Serviço de cotações do Melhor Envio



Agora ficou mais fácil ter o serviço de cotações do Melhor Envio no seu projeto de e-commerce.

## Índice

* [Instalação](#instalacao)
* [Cofiguração Inicial](##configuração-inicial)
* [Exemplos de uso](##Criando-a-instância-calculadora)
    * [Criação da calculadora](###Criando-a-instância-calculadora)
    * [Montando o payload da calculadora](###Montando-o-payload-da-calculadora)
    * [Adicionando CEPs de origem e destino](####Adicionando-CEPs-de-origem-e-destino)
    * [Produtos](###Produtos)
        * [Adicionando os produtos para cotação](###Adicionando-os-produtos-para-cotação)
    * [Pacotes](###Pacotes)
        * [Adicionando os pacotes para cotação](####Adicionando-os-pacotes-para-cotação)
    * [Adicionando os serviços das transportadoras](####Adicionando-os-serviços-das-transportadoras)
    * [Adicionando serviços adicionais](####Adicionando-serviços-adicionais)
    * [Retornando a cotação](####Retornando-as-informações-da-cotação)
* [Mais exemplos](##Mais-Exemplos)
* [Testes](##Testes)
* [Changelog](##Changelog)
* [Contribuindo](##Contribuindo)
* [Segurança](##Segurança)
* [Créditos](##Créditos)
* [Licença](##Licença)

## Dependências

### require 
* PHP >= 5.6
* Ext-json = *
* Guzzlehttp/guzzle >= 6.5

### require-dev
* phpunit/phpunit >= 5


## Instalação

Você pode instalar o pacote via composer, rodando o seguinte comando:

```bash
composer require fernandoebert/melhorenvio
```

## Configuração inicial

A instância criada de Shipment permite que você passe como parâmetros o seu token e o ambiente que você trabalhará, assim terá a autenticação pronta. 

Lembrando que só será válido, se a criação do token pertencer ao mesmo ambiente passado como parâmetro. 

```php
require "vendor/autoload.php";

use MelhorEnvio\Shipment;
use MelhorEnvio\Resources\Shipment\Package;
use MelhorEnvio\Enums\Service;
use MelhorEnvio\Enums\Environment;

// Create Shipment Instance
$shipment = new Shipment('your-token', Environment::PRODUCTION);
```

## Criando a instância calculadora

Neste exemplo você criará uma instância para calculadora no seu código.

```php
// Create Calculator Instance
    $calculator = $shipment->calculator();
```

## Montando o payload da calculadora

### Adicionando CEPs de origem e destino

Nesta parte você deve definir os CEPs de origem e destino respectivamente. 

```php
//Builds calculator payload
$calculator->postalCode('01010010', '20271130');
```

### Produtos

#### Adicionando os produtos para cotação

Nesta parte, você irá definir os produtos que servirão para a sua cotação as informações que devem ser passadas como parâmetro são as seguintes:

* Altura
* Largura
* Comprimento
* Peso
* Valor segurado
* Quantidade

Lembrando que o valor segurado por padrão deve ser o valor do produto.

```php
$calculator->addProducts(
        new Product(uniqid(), 40, 30, 50, 10.00, 100.0, 1),
        new Product(uniqid(), 5, 1, 10, 0.1, 50.0, 1)
    );
```

### Pacotes

#### Adicionando os pacotes para cotação

Nesta parte, você irá definir os pacotes que servirão para sua cotação, as informações que devem ser passadas como parâmetro são as seguintes:

* Altura
* Largura
* Comprimento
* Peso
* Valor segurado

**As dimensões sempre devem ser passadas em centímetros e o peso em quilogramas. São as unidades que o Melhor Envio opera.**

Lembrando que o valor segurado por padrão deve ser o valor do produto em Reais.

```php
 $calculator->addPackages(
        new Package(12, 4, 17, 0.1, 6.0),
        new Package(12, 4, 17, 0.1, 6.0),
        new Package(12, 4, 17, 0.1, 6.0),
        new Package(12, 4, 17, 0.1, 6.0)
    );
```

**É importante ressaltar que os métodos de PACOTES e PRODUTOS não poderão ser utilizados conjuntamente, devendo ser utilizado apenas um ou outro.**

### Adicionando os serviços das transportadoras

Se você desejar customizar, nesta parte serão escolhidos os serviços das transportadoras que você deseja utilizar. Hoje, no Melhor Envio, estão disponíveis:

* Correios
* Jadlog
* Via Brasil
* Azul Cargo
* Latam Cargo

```php
$calculator->addServices(
        Service::CORREIOS_PAC, 
        Service::CORREIOS_SEDEX,
        Service::CORREIOS_MINI,
        Service::JADLOG_PACKAGE, 
        Service::JADLOG_COM, 
        Service::AZULCARGO_AMANHA,
        Service::AZULCARGO_ECOMMERCE,
        Service::LATAMCARGO_JUNTOS,
        Service::VIABRASIL_RODOVIARIO
    );
```

### Adicionando serviços adicionais

Se você desejar customizar, pode configurar alguns serviços adicionais na sua cotação, são eles:

* Mão própria
* Aviso de recebimento
* Coleta

Lembrando que a adição desses serviços podem gerar acréscimos no preço na hora da cotação.

```php
$calculator->setOwnHand();
$calculator->setReceipt();
$calculator->setCollect();
``` 


### Retornando as informações da cotação

Aqui você retornará as informações do payload montado.

```php
$quotations = $calculator->calculate();
```

### Mais exemplos

[Aqui você pode acessar mais exemplos de implementação](/examples)

### Testes

Dentro do projeto você encontrará alguns documentos de teste baseados em testes unitários


Você pode usar na aplicação tanto o comando:
``` bash
composer test
```
Quanto o comando:
```bash
vendor/bin/phpunit tests 
```

### Changelog

Consulte [CHANGELOG](CHANGELOG.md) para mais informações de alterações recentes.

## Contribuindo

Consulte [CONTRIBUTING](CONTRIBUTING.md) para mais detalhes.

### Segurança

Se você descobrir algum problema de segurança, por favor, envie um e-mail para tecnologia@melhorenvio.com, ao invés de usar um *issue tracker*.


## Licença

Melhor Envio. Consulte [Arquivo de lincença](LICENSE.md) para mais informações.
