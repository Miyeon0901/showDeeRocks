#!/bin/bash

cd /var/www/html/etc/
echo "Start to update ShowdeeRocks homepage automatically..."
./update-article.sh
./update-cache.sh
echo "Finish all task for updating homepage"
