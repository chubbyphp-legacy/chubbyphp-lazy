# chubbyphp-lazy

[![Build Status](https://api.travis-ci.org/chubbyphp/chubbyphp-lazy.png?branch=master)](https://travis-ci.org/chubbyphp/chubbyphp-lazy)
[![Total Downloads](https://poser.pugx.org/chubbyphp/chubbyphp-lazy/downloads.png)](https://packagist.org/packages/chubbyphp/chubbyphp-lazy)
[![Latest Stable Version](https://poser.pugx.org/chubbyphp/chubbyphp-lazy/v/stable.png)](https://packagist.org/packages/chubbyphp/chubbyphp-lazy)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/chubbyphp/chubbyphp-lazy/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/chubbyphp/chubbyphp-lazy/?branch=master)

## Description

Model and repository made simple.

## Requirements

 * php: ~7.0
 * container-interop/container-interop: ~1.1

## Installation

Through [Composer](http://getcomposer.org) as [chubbyphp/chubbyphp-lazy][1].

## Usage

### LazyCommand

#### Additional Requirements

 * psr/http-message: ~1.0

```{.php}
<?php

use Chubbyphp\Lazy\LazyCommand;
use Symfony\Component\Console\Input\InputInterface as Input;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface as Output;

$container['service'] = function (Input $input, Output $output) {
    // run some lazy logic
};

$command = new LazyCommand(
   $container,
   'service',
   'name',
   [
       new InputArgument('argument'),
   ],
   'description',
   'help'
);

$command->run();
```

### LazyMiddleware

#### Additional Requirements

 * symfony/console: ~3.1

```{.php}
<?php

use Chubbyphp\Lazy\LazyMiddleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$container['service'] = function (Request $request, Response $response) {
    // run some lazy logic
};

$middleware = new LazyMiddleware($container, 'service');
$response = $middleware($request, $response);
```

[1]: https://packagist.org/packages/chubbyphp/chubbyphp-lazy

## Copyright

Dominik Zogg 2016
