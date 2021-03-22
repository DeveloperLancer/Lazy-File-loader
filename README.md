# Lazy File Loader [![Packagist](https://img.shields.io/packagist/dt/dev-lancer/lazy-file-loader.svg)](https://packagist.org/packages/dev-lancer/lazy-file-loader)

## Installation
This library can installed by issuing the following command:
```bash
composer require dev-lancer/lazy-file-loader
```

## Example

### class LazyCharsLoader
```php
<?php
    require 'vendor/autoload.php';
    
    use DevLancer\LazyFileLoader\LazyCharsLoader;

    $file = "LICENSE"; //path to file

    $loader = new LazyCharsLoader($file); //offset: 0
    
    print_r($loader->load()); //Length: -1, Output: the entire LICENSE file
    print_r($loader->load(11)); //Length: 11, Output: "MIT License"
    
    $loader = new LazyCharsLoader($file, 15);//offset: 15
    print_r($loader->load(35)); //Length: 35, Output: "Copyright (c) 2021 DeveloperLancer"
    
    $loader = new LazyCharsLoader($file, -1);//offset: -1
    print_r($loader->load(11)); //Length: 11, Output: "SOFTWARE."
```

### class LazyLineLoader
```php
<?php
    require 'vendor/autoload.php';
    
    use DevLancer\LazyFileLoader\LazyLineLoader;

    $file = "LICENSE"; //path to file
    
    $loader = new LazyLineLoader($file); //offset: 0, separator: \n
    print_r($loader->load()); //Length: -1, Output: array[] the entire LICENSE file
    print_r($loader->load(1)); //Length: 1,
    //Output: Array (
    //  [0] => MIT License
    //)

    $loader = new LazyLineLoader($file, 2);//offset: 2
    print_r($loader->load(1)); //Length: 1
    //Output: Array (
    //  [0] => Copyright (c) 2021 DeveloperLancer
    //)
    
    print_r($loader->load(3)); //Length: 3
    //Output: Array (
    //  [0] => Copyright (c) 2021 DeveloperLancer
    //  [1] =>
    //  [2] => Permission is hereby granted, free of charge, to any person obtaining a copy
    //)
    
    $loader = new LazyLineLoader($file, -2);//offset: -2
    print_r($loader->load(1)); //Length: 10,
    //Output: Array (
    //  [0] => SOFTWARE.
    //)
```
