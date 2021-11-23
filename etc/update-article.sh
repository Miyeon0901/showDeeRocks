#!/bin/bash

cd /var/www/html/
echo "Get data from Google-SpreadSheet and Update html files..."
node javascript/readSpreadSheet.js > article.html
sudo chown -R -h ec2-user article.html
sudo chgrp -R -h ec2-user article.html
sudo chcon -R -t httpd_sys_script_exec_t article.html
echo "Finish update-article..."
