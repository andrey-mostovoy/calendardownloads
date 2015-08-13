#!/bin/sh

set -e

echo "cd /var/www/calendardownloads/master" >> /var/www/.profile

echo "export APPLICATION_ROOT=/var/www/calendardownloads/master/" >> /var/www/.profile
echo "export APPLICATION_PROJECT=calendardownloads" >> /var/www/.profile
echo "export APPLICATION_PLATFORM=dev" >> /var/www/.profile
echo "export APPLICATION_REVISION=1" >> /var/www/.profile

mkdir -p /var/www/calendardownloads/master
chown www-data:www-data -R /var/www

echo "www-data ALL=(ALL:ALL) NOPASSWD: ALL" >> /etc/sudoers

apt-get update
apt-get -y upgrade

mv /build/conf/20-dev-init.sh /etc/my_init.d/20-dev-init.sh
