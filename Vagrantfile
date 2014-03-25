Vagrant.configure("2") do |config|

  config.vm.box = "precise64"
  config.vm.host_name = "gravata"
  config.vm.box_url = "http://files.vagrantup.com/precise64.box"
  config.vm.synced_folder('.', "/var/www/gravata", :mount_options => ['dmode=777','fmode=777'])
  config.vm.network "forwarded_port", guest: 80, host: 8098
  config.vm.network "private_network", ip: "192.168.42.21"

  config.vm.provider "virtualbox" do |v|
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  end

  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = "vagrant/manifests"
    puppet.manifest_file = "gravata.pp"
    puppet.module_path = "vagrant/modules"
  end

end
# vim: set ft=ruby:
