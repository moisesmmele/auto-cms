#!/bin/bash
set -e

echo "Starting entrypoint..."

# 2. Run Phinx migrations
echo "Running database migrations with Phinx..."
./vendor/bin/phinx migrate -e production

# 3. Create default admin user
echo "Creating default admin user..."
php database/create_db_admin_user.php

# 4. Start supervisord
echo "Starting supervisord..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
