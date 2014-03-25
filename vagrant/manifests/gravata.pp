Exec { path => [ "/bin/", "/sbin/" , "/usr/bin/", "/usr/sbin/" ] }

stage { 'preinstall':
    before => Stage['main']
}

stage { 'application': }
Stage['main'] -> Stage['application']

class apt_get_update {
    exec { 'apt-get -y update': }
}

class { 'apt_get_update':
    stage => preinstall
}

class { 'composer':
    stage => 'application'
}

include gravata
include composer
