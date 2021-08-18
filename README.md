# Introducción

Esta es la aplicación encargada de gestionar todos los usuarios de todas las aplicaciones y los tenants.  
Tiene como finalidad emitir accesos tokens válidos para el consumo del backend.  
Este access token se validará en cada petición que se realice para verificar la autenticidad del mismo.

# Requisitos para el desarrollo

 - PHP >= 7.4
 - Swoole PHP >= 4.4，con `Short Name` desactivado (swoole.use_shortname = off en el php.ini)
 - OpenSSL PHP
 - JSON PHP
 - PDO PHP
 - Redis PHP

# Instalación

```bash
$ composer install
```

# Correr para desarrollo local
Una vez instalado, puedes correr la app usando los siguientes comandos:

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

Para evitar este comportamiento se implemento un hot-reload util para el desarrollo que realiza este proceso automatico si se ejecuta la app de la siguiente manera:
```bash
$ composer start-dev
```

# Correr con Docker

Buildear
```bash
$ docker build -t http-hyperf-skeleton .
```

Correr
```bash
$ docker run -d --network=host http-hyperf-skeleton:latest 
```

# Test

Para correr los test basta con ejecutar el siguiente comando:

```bash
$ composer test
```

# Coverage

Para correr los test de coverage basta con ejecutar el siguiente comando:

```bash
$ composer coverage
```

Los reportes se encontrarán en la carpeta "coverage/"

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

# Consola

```bash
$ php bin/hyperf.php [command] [options] [arguments]
```

<pre>
<h4>Options:</h4>
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

<h4>Available commands:</h4>
  help                  Display help for a command
  info                  Dump the server info.
  list                  List commands
  migrate               
  start                 Start hyperf servers.

 <b>db</b>  
  db:seed           

 <b>describe</b>
  describe:aspects      Describe the aspects.
  describe:listeners    Describe the events and listeners.
  describe:routes       Describe the routes information.

 <b>gen</b>  
  gen:amqp-consumer     Create a new amqp consumer class
  gen:amqp-producer     Create a new amqp producer class
  gen:aspect            Create a new aspect class
  gen:command           Create a new command class
  gen:constant          Create a new constant class
  gen:controller        Create a new controller class
  gen:job               Create a new job class
  gen:kafka-consumer    Create a new kafka consumer class
  gen:listener          Create a new listener class
  gen:middleware        Create a new middleware class
  gen:migration         Generate a new migration file
  gen:model             
  gen:nats-consumer     Create a new nats consumer class
  gen:nsq-consumer      Create a new nsq consumer class
  gen:process           Create a new process class
  gen:request           Create a new form request class
  gen:resource          create a new resource
  gen:seeder            Create a new seeder class

 <b>migrate</b>  
  migrate:fresh         
  migrate:install       
  migrate:refresh       
  migrate:reset         
  migrate:rollback      
  migrate:status        

 <b>vendor</b>  
  vendor:publish        Publish any publishable configs from vendor packages.
</pre>
