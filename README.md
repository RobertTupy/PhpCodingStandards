# PHP coding standards
Coding standards following [PSR-1/PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)

## editorconfig
Using editorconfig provides crosseditor standard for indentation style, file encoding, line ending etc.

## code examples

[examples](./example/example.php)

directory contains example files, class and code blocks examples following PSR-1 and PSR-2 standards

Check can be done by PHP_CodeSniffer. You can download PHP CodeSniffer. If you have PEAR installed, it’s easier:

```pear install PHP_CodeSniffer```

Verify PHP CodeSniffer with:

```phpcs --version```

```phpcs --standard=PSR2 ./example```

## unit tests example

Example folder also contains test to Company\LeapYear class, with detailed explanations how to organize unit tests.

How to enable PHPUnit from `phpunit.phar` in [PHPStorm](https://www.jetbrains.com/help/phpstorm/2016.2/enabling-phpunit-support.html)
