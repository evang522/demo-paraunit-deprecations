To reproduce: 

```
docker-compose run --user 1000:1000 php bash

// to run repo with merely PHPUnit (no deprecations)
vendor/bin/phpunit

// to run with paraunit and see deprecations
vendor/bin/paraunit run --chunk-size 160 --parallel=2

```