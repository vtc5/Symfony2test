mkdir /tmp/cacheSymfony
mkdir /tmp/logSymfony
chmod -R 775 /tmp/cacheSymfony
chmod -R 775 /tmp/logSymfony
cd /vagrant/symfony
composer update
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
php app/console doctrine:fixtures:load -n
rm -R /tmp/cacheSymfony
rm -Rr /tmp/logSymfony
mkdir /tmp/cacheSymfony
mkdir /tmp/logSymfony
chown -R www-data:www-data /tmp/cacheSymfony
chown -R www-data:www-data /tmp/logSymfony
chmod -R 775 /tmp/cacheSymfony
chmod -R 775 /tmp/logSymfony

