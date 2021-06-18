# Introducción

Esta es la aplicación encargada de gestionar todos los usuarios de todas las aplicaciones y los tenants.  
Tiene como finalidad emitir accesos tokens válidos para el consumo del backend.  
Este access token se validará en cada petición que se realice para verificar la autenticidad del mismo.

# Requisitos para el desarrollo

 - PHP >= 7.4
 - Swoole PHP >= 4.4，con `Short Name` desactivado
 - OpenSSL PHP
 - JSON PHP
 - PDO PHP
 - Redis PHP

# Instalación

```bash
$ composer install
```

Una vez instalado, puedes correr la app usando el siguiente comando:

```bash
$ composer start
```

Este comando iniciará la aplicación en el puerto `9501`. Puedes visitar el sitio en `http://localhost:9501/`

Esta aplicación corre mediante CLI en vez de en un webserver tradicional, por lo tanto cualquier cambio que realices
en el código no impactara hasta que hagas un:

```bash
$ CTRL + C
$ composer start
```

# Test

Para correr los test basta con ejecutar el siguiente comando:

```bash
$ composer test
```

# Analizar el código estáticamente (BUGS)

Para ejecutar el análisis estático de código para verificar posibles bugs basta con ejecutar el siguiente comando:

```bash
$ composer analyse
```

# Formatear el código

Para hacer un beautify del código y que todos sigamos el mismo criterio a la hora de codear puedes ejecutar:

```bash
$ composer cs-fix
```
