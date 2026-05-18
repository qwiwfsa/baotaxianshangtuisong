#!/bin/bash
# 百度主动推送 - 每日自动提交城市分站URL
URL_FILE=/www/wwwroot/www.yaozijin.com/fenzhan/baidu_push_urls.txt
API="http://data.zz.baidu.com/urls?site=www.yaozijin.com&token=kpdoPMbbubR3edI2"
LOG=/www/wwwroot/www.yaozijin.com/fenzhan/baidu_push.log

# Generate all URLs first
echo "$(date '+%Y-%m-%d %H:%M:%S') - Starting push..." >> $LOG

# Push all URLs (Baidu handles quota internally)
curl -s -H "Content-Type: text/plain" --data-binary @$URL_FILE $API >> $LOG 2>&1

echo "" >> $LOG
