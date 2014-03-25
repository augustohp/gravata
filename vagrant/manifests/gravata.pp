Exec { path => [ "/bin/", "/sbin/" , "/usr/bin/", "/usr/sbin/" ] }

stage { 'preinstall':
    before => Stage['main']
}

class apt_get_update {
    exec { 'apt-get -y update': }
}

class { 'apt_get_update':
    stage => preinstall
}

include gravata
