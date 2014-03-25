class gravata {
    $packages = ['php5', 'php5-gd', 'php5-curl', 'php5-imagick', 'curl']

    package { $packages:
        ensure => present
    }

    apache::vhost { 'gravata.dev':
        docroot => '/var/www/gravata',
        domain => 'gravata.dev',
        vhost_name => 'gravata',
        port => 80
    }

}
