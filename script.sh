crontab -l > mon_cron
cat >> mon_cron << EOF
*/5 * * * * /usr/bin/sudo /usr/local/bin/aws-ec2-nginx-cf/cron.sh >> /var/www/html/logs/cron.log
EOF
crontab < mon_cron
rm -f mon_cron