#!/bin/bash
set -e

echo "Starting entrypoint..."

# 2. Run Phinx migrations
echo "Running database migrations with Phinx..."
./vendor/bin/phinx migrate -e production

# 3. Create default admin user
echo "Creating default admin user..."

cd database
php create_db_admin_user.php
cd ..

# 4. Start supervisord
echo "Starting supervisord..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
