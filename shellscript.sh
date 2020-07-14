#!/bin/bash

if [ ! -f tagsoup-1.2.1.jar ]
then
	wget http://vrici.lojban.org/~cowan/XML/tagsoup/tagsoup-1.2.1.jar
fi
for i in {1..60}; 
do 
	currDate=$(date +%Y-%m-%d-%H-%S)
	currHTML=$currDate.html
	wget http://wsj.com/mdc/public/page/2_3021-activnnm-actives.html
	mv 2_3021-activnnm-actives.html $currHTML
	java -jar tagsoup-1.2.1.jar --files $currHTML
	currXHTML=$currDate.xhtml
	python3 xhtmlToCsv.py $currXHTML $currDate
	sleep 60
done	

