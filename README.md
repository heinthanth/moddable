# Moddable

Simple, moddable PHP micro-framework based on Symfony

```
  __  __  __     _    _ _ _  _    _ ____
 |  \/  |/  \ __| |__| | | || |__/ |__ /
 | |\/| | () / _` / _` |_  _| '_ \ ||_ \
 |_|  |_|\__/\__,_\__,_| |_||_.__/_|___/

```

Build your website with Moddable MVC.

## Development

```shell
$ git clone https://github.com/heinthanth/moddable
$ cd moddable
$ composer install

$ symfony server:start --port=8000 --passthru=index.php || php -S localhost:8000 -t public/
```

Access your website at http://localhost:8000 && Hack it!
