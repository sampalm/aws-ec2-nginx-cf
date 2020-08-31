crontab -l > mon_cron
cat >> mon_cron << EOF
* * * * * /usr/bin/sudo sh /usr/local/bin/aws-ec2-nginx-cf/scripts/cron.sh >> /var/www/html/logs/cron.log 2>&1
EOF
crontab < mon_cron
rm -f mon_cron