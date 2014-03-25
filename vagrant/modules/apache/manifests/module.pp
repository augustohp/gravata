define apache::module ($module_name) {
    include apache
    exec { "install_apache_module":
        unless => "readlink -e /etc/apache2/mods-enabled/${name}.load",
        command => "a2enmod ${module_name}",
        notify => Service["apache2"],
    }
}
