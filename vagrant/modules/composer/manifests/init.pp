class composer {
    exec { 'download-composer':
        command => 'curl -sS https://getcomposer.org/installer | php',
        creates => '/var/www/gravata/composer.phar',
        cwd => '/var/www/gravata'
    }

    exec { 'install-dependencies':
        cwd => '/var/www/gravata',
        command => 'php composer.phar install --no-interaction',
        require => [Exec['download-composer']],
    }
}
