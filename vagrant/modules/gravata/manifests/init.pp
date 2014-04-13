class gravata {
    $packages = [
        'php5', 'php5-cli', 'php5-gd', 'php5-curl', 'php5-imagick',
        'libapache2-mod-php5',
        'curl'
    ]

    package { $packages:
        ensure => present
    }

    apache::vhost { 'gravata.dev':
        docroot => '/var/www/gravata',
        domain => 'gravata.dev',
        vhost_name => 'gravata',
        port => 80
    }

    exec { 'download-composer':
        command => 'curl -sS https://getcomposer.org/installer | php',
        creates => '/var/www/gravata/composer.phar',
        cwd => '/var/www/gravata',
        require => [Package['curl'], Package['php5-cli'], Exec['apt-get update']]
    }

    exec { 'install-dependencies':
        cwd => '/var/www/gravata',
        command => 'php composer.phar install --no-interaction',
        require => [Exec['download-composer']],
    }
}
