#!/bin/bash

cd /var/www/html/
echo "Update tag in order to reset cache..."
sudo sed -i '/<!-- delete-line -->/d' index.html
sudo sed -i'' -r -e "/<\!-- add-line1 -->/a\        <link rel=\"stylesheet\" href=\"./css/index.css?ver=`date +%y%m%d-%H%M`\" type=\"text\/css\"> <\!-- delete-line -->" index.html
sudo sed -i'' -r -e "/<\!-- add-line2 -->/a\                최근 수정일 : `date +%Y" "-" "%m" "-" "%d" "` <\!-- delete-line -->" index.html
sudo sed -i'' -r -e "/<\!-- add-line3 -->/a\            <div include-html=\"./article.html?ver=`date +%y%m%d-%H%M`\"></div> <\!-- delete-line -->" index.html
echo "Finish update-cache"
