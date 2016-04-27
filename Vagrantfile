# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.define "web", primary: true  do |web|
    web.vm.box = "ubuntu/trusty64"
    web.vm.hostname = "symfony.dev"
    web.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'" # suppress tty errors workaround

    web.vm.network "forwarded_port", guest: 80, host: 8080
    web.vm.network "forwarded_port", guest: 5432, host: 15432

    web.vm.provider "virtualbox" do |vb|
      vb.customize ["modifyvm", :id, "--memory", "2500"]
    end

    # initial system upgrade
    web.vm.provision "shell", inline: 'apt-get update && apt-get -y dist-upgrade 2>&1'
    web.vm.provision "shell", inline: 'apt-get -y autoremove 2>&1'

    # install pacakges required
    web.vm.provision "shell", inline: 'apt-get install -y mc apache2 libapache2-mod-php5 php5-gd 2>&1'
    web.vm.provision "shell", inline: 'apt-get install -y php5-pgsql php5-mysql php5-curl 2>&1'
    web.vm.provision "shell", inline: 'apt-get install -y libdbd-pg-perl 2>&1'
    web.vm.provision "shell", inline: 'sudo DEBIAN_FRONTEND=noninteractive aptitude install -q -y mysql-server 2>&1'
    web.vm.provision "shell", inline: 'apt-get install -y curl php5-cli git phpunit 2>&1'
    web.vm.provision "shell", inline: 'curl -s https://getcomposer.org/installer | php'
    web.vm.provision "shell", inline: 'mv composer.phar /usr/local/bin/composer'

    # put config files in place
    web.vm.provision "shell", inline: 'cp -rf /vagrant/deploy/apache2 /etc'
    web.vm.provision "shell", inline: 'cp -rf /vagrant/deploy/php5 /etc'

    # enable apache modules
    web.vm.provision "shell", inline: 'a2enmod rewrite'

    # restart services
    web.vm.provision "shell", inline: 'service apache2 restart'

    
    web.vm.synced_folder ".", "/vagrant", :group => "www-data", :mount_options => ['dmode=775','fmode=664']

    web.vm.provision "shell", inline: 'cat /vagrant/deploy/deploy.sh | tr -d "\r" | /bin/bash 2>&1'

  end

end
