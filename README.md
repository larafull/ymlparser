# Laravel YML (Yandex XML format) Parser
Parser for yml(yandex.market.ru) files adapted for Laravel 5.5+.

Forked from https://github.com/serkin/ymlparser

Thanks for Serkin Alexander!

YMLParser out of box have two drivers for different file sizes:
* XMLReader - for medium and large xml files
* SimpleXML - for small xml files


## Laravel YML parsing notice:

On current step Laravel is not required, but development of this package is going inside Laravel project.

## Installation

Package requires php-xmlrpc and php-mbstring

```
sudo apt-get install php-xmlrpc php-mbstring
```

---

Require package via Composer:

```
composer require larafull/ymlparser:dev-master
```

## Usage

### Remote YML parsing in Laravel etc

Since v1.2 remote parsing is available:

```php

use YMLParser\YMLParser;
use YMLParser\Driver\XMLReader;


$url = 'https://somedomain/somefolder/somefile.yml.xml';

$parser = new YMLParser(new XMLReader);

$parser->open($url);

$offers = $parsers->getOffers(); // etc

```


### Getting all offers from file

```php
use YMLParser\YMLParser;
use YMLParser\Driver\XMLReader;

$filename = '/path/to/file/file.xml';

//   User XMLReader driver large xml files or SimpleXML driver for small xml files.

$parser = new YMLParser(new XMLReader);
$parser->open($filename); // throws \Exception if $filename doesn't exist or empty
foreach($parser->getOffers() as $offer): // YMLParser::getOffers() returns \Generator
    echo $offer['url'];
endforeach;
```
### Using filters for offers:

YMLParser::getOffers() can take filter function as an argument. Filter should be an anonymous function which returns true or false
```php

use YMLParser\YMLParser;
use YMLParser\Driver\SimpleXML;

$filename = '/path/to/file/file.xml';

$parser = new YMLParser(new SimpleXML);
$parser->open($filename);

// Anonnymous filter function example:

$filter = function($element) {
    return !empty($element['url']);
}; 

$offers = iterator_to_array($parser->getOffers($filter));

// Let's dump first offer via Laravel dump():

dump($offers[0]['params']);

```

## Dependencies
* PHP: >= 7.1
* xmlrpc extension
* mbstring extension


## Modifications after fork

DriverInterface can be changed. For capability check static variables will be added.

Migrations to create models from YML will be available later.

## Contribution and your ideas

Create pull requests or/and message me here:

Telegram: @vvmspace

Twitter: @vvmspace

VK: https://vk.com/it007

Instagram: https://instagram.com/insta.tagil

E-mail: vvmspace@gmail.com