# Meff

This is a fork of [tegansnyder/meff](https://github.com/tegansnyder/meff) fixed and packed as Composer package.

The purpose of this utility is to list all the files responsible for a Magento extension and their locations. Think of it as an experiment in building a automatic modman file generator. Key word "experiment" :)

## Installation

Install in your project as dev dependency with Composer:

```bash
composer require --dev mmenozzi/meff dev-master
```

## Usage
Simple clone this repo and run the meff.php file via the command line passing it a extension name and full path to your Magento root directory.
```bash
vendor/bin/meff Extension_Name
```
You can also specify a different Magento root directory as second argument:

```bash
vendor/bin/meff Extension_Name ./path/to/magento
```

## Caveats
I haven't tested this on all possible senarios. I appreciate the communities support in testing it with extensions. Magento allows you to construct extensions that can pull files in from a wide variety of sources. I attempt parse the source code looking for mentions of this files and then attempt to determine their existances passed on a few testable assumptions. I'm still working on a few things:
 * Magento allows you to define a helper function to assist in returning a filename using the addItem method. Since this extension currently doesn't instantiate the Magento framework I haven't added this feature.
 * I attempt to pickup any files the extension places in the /lib folder by parsing the source of the php files in the extension and looking for new class declarations. In my tests it is working, but if an issue is found please submit a PR.
 * The code is a bit messy and documentation is limited in some places. I appreciate PR's for refactoring.

## License

See LICENSE file.
