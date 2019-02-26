# droid-speak [![Build Status](https://travis-ci.org/lzakrzewski/droid-speak.svg?branch=master)](https://travis-ci.org/lzakrzewski/droid-speak)
The droid speak translator. It translates droid speak (binary) to english.

#### Installation
`composer require lzakrzewski/droid-speak`

#### Usage 
```php
$translator = new DroidSpeakTranslator();
$output = $translator->translate(['01000011']);

//Output
Array
(
    [0] => C
)

```

#### Example input
The input is an array. The array can be multidimensional or nested.

```php
Array
(
    [cell] => 01000011 01100101 01101100 01101100 00100000 00110010 00110001 00111000 00110111
    [block] => 01000100 01100101 01110100 01100101 01101110 01110100 01101001 01101111 01101110 00100000 01000010 01101100 01101111 01100011 01101011 00100000 01000001 01000001 00101101 00110010 00110011 00101100
)
```

#### Example output
The translation of [input](#example-input). 
```php
Array
(
    [cell] => Cell 2187
    [block] => Detention Block AA-23,
)
```
