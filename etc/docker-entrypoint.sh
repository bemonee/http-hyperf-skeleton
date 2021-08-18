#!/bin/sh

echo "Applying database migrations"
php ./bin/hyperf.php migrate

echo "Starting server"
php ./bin/hyperf.php start
