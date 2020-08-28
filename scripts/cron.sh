echo "iniciando script..."
cd /var/www/html
sudo bash -c "mon-put-instance-stats.py --mem-util --disk-space-util --disk-space-avail --disk-space-used --disk-path=/ --loadavg-percpu --verify --verbose > logs/log.txt"
echo "script executado"