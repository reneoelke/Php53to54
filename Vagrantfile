# -*- mode: ruby -*-
# vi: set ft=ruby :

#
# Global config variables
#

$vbox_hostonlyif_name = ""
$vbox_hostonlyif_address = "192.168.100.1"

$vm_host_name = "zs54"
$vm_ip_address = "192.168.100.11"
$vm_mac_address = "080027ACF5D0"

#
# Plugins
#

class HostnameMiddleware
  def initialize(app,env)
    @app = app
    @env = env
  end

  def call(env)
    @env = env
    add_hostname
    @app.call(env)
  end

  def add_hostname
    host_name = @env[:vm].config.vm.host_name
	ip_address = nil
    @env[:vm].config.vm.networks.each do |type, args|
      if type == :hostonly && args[0].is_a?(String)
        ip_address = args[0]
      end
    end

    message = "Hostname already available in /etc/hosts..."
    `grep -P "^#{ip_address}[\\s]+(.*[\\s])?#{host_name}([\\s].*)?$" /etc/hosts`
    if $?.exitstatus == 1
      str = ip_address.to_s + ' ' + host_name
      `sudo su root -c "echo '' >> /etc/hosts"`
      `sudo su root -c "echo '# VAGRANT-BEGIN // #{host_name}' >> /etc/hosts"`
      `sudo su root -c "echo '#{str}' >> /etc/hosts"`
      `sudo su root -c "echo '# VAGRANT-END // #{host_name}' >> /etc/hosts"`
      message = 'Addedd hostname to /etc/hosts...';
    end

    @env[:ui].info "#{message}"
  end
end

Vagrant.actions[:up].use(HostnameMiddleware)

#
# Main
#

Vagrant::Config.run do |config|
  config.vm.box = "lucid64"
  config.vm.host_name = "#{$vm_host_name}"
  config.vm.network :hostonly, "#{$vm_ip_address}", { :mac => "#{$vm_mac_address}" }
  config.vm.provision :chef_solo do |chef|
    chef.cookbooks_path = "cookbooks"
    chef.add_recipe "zend-server"
  end
end
