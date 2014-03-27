class apache {
    package { "apache2":
        ensure => present
    }

    service { "apache2":
        enable => true,
        ensure => running,
        require => Package["apache2"]
    }

    file { '/etc/hosts':
        source => '/vagrant/vagrant/modules/apache/files/hosts'
    }
}
