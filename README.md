deable / encore
===============

Simple asset loader for webpack or webpack-encore - to include your builded styles and javascripts.
Thanks to this library, you can simplify your workflow with the frontend and [Nette Framework](https://nette.org/).

Requirements
------------

This library was developed for PHP 7.3 or newer, designed for [Nette Framework](https://nette.org/) version 3.1 or newer.

Installation
------------

The best way to install this library is using [Composer](https://getcomposer.org/):

```sh
$ composer require deable/encore
```

Usage
-----

Add extension to your application configuration: 

```yarn
extensions:
    encore: Deable\Encore\EncoreExtension(%wwwDir%)
```

Example webpack configuration is in example dir.

Contributing
------------
This is an open source, community-driven project. If you would like to contribute,
please follow the code format as used in current sources and submit a pull request.
