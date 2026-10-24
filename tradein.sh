#!/usr/bin/env bash

chown bitnami:daemon -R storage bootstrap/cache
find storage bootstrap/cache -type f -exec chmod 664 {} \;
find storage bootstrap/cache -type d -exec chmod 775 {} \;


