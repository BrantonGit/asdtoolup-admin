#!/usr/bin/env bash

# Web server user/group. Debian/Ubuntu (Apache or PHP-FPM): www-data.
# Override when needed: WEB_USER=nginx WEB_GROUP=nginx ./tradein.sh
WEB_USER="${WEB_USER:-www-data}"
WEB_GROUP="${WEB_GROUP:-$WEB_USER}"

chown -R "$WEB_USER:$WEB_GROUP" storage bootstrap/cache
find storage bootstrap/cache -type f -exec chmod 664 {} \;
find storage bootstrap/cache -type d -exec chmod 775 {} \;

# Receipts are written to /uploads at the app root (the "local" disk in
# config/filesystems.php is rooted at base_path()), so it must be writable
# by the web server too.
mkdir -p uploads
chown -R "$WEB_USER:$WEB_GROUP" uploads
find uploads -type d -exec chmod 775 {} \;
find uploads -type f -exec chmod 664 {} \;

# Passport/OAuth keys must only be 400, 440, 600, 640 or 660.
# league/oauth2-server throws on every token check if they are 664/644,
# which makes all auth:api routes return 500. This must run AFTER the
# blanket chmod above.
for key in storage/oauth-private.key storage/oauth-public.key; do
    if [ -f "$key" ]; then
        chown "$WEB_USER:$WEB_GROUP" "$key"
        chmod 660 "$key"
    fi
done
