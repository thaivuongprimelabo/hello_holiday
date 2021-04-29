#!/bin/sh

if [ -f "/var/www/html/includes/define.php.backup" ]; then
  mv /var/www/html/includes/define.php.backup /var/www/html/includes/define.php
fi