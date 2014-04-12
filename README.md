# Gravata

Porque seu [gravatar][] precisa de uma gravata!

## Requisitos

1. [VirtualBox][].
1. [Vagrant][].
1. Uma conta no [Gravatar][] (opcional).

## Instalação

1. Siga as instruções de [instalação do Vagrant][1] se você ainda
   não as tiver seguido.
1. Clone este repositório usando o [Git][].
1. Usando um terminal, vá até o diretório raiz da aplicação
   (o que tem o arquivo `Vagrantfile`).
	1. Digite `vagrant up` para construir a [VM] ou ligá-la (caso esteja desligada).
	1. Digite `vagrant ssh` para conectar via [SSH] à [VM][].
	1. Digite `cd /var/www/gravata` para ir ao diretório raiz da aplicação dentro da [VM][].
	1. Digite `curl -sS https://getcomposer.org/installer | php` para instalar o [Composer][].
	1. Digite `./composer.phar install` para instalar as dependências da aplicação.
1. Acrescente o *host* `gravata.dev` apontando para `192.168.42.21`
   na sua máquina ([precisa de ajuda?][2]).

Os comandos acima lhe darão uma [VM][] rodando [Ubuntu][] 12.04, somente
processadores 64bit são suportados. Se você precisar rodar este repositório
em uma máquina 32 bits, entre em contato [criando uma issue][issue].

## Rodando os testes

As instruções abaixo consderam que as instruções de instalação foram
seguidas e que você esteja em um terminal, *na pasta raiz da aplicação*.

Primeiro você precisa abrir uma conexão [SSH][] para dentro da [VM][]:

	$ vagrant ssh
	$ cd /var/www/gravata

O segundo comando o direciona para o diretório da aplicação dentro da [VM][].
A aplicação até o momento possui duas suites:

- Integração (usando [Behat][]).
- Unitária (usando [PHPUnit][]).

Para rodar a suite do [Behat][]:

	$ vendor/bin/behat

Para rodar a suíte do [PHPUnit][]:

	$ vendor/bin/phpunit tests

# Dúvidas? Problemas? Sugestões?

[Crie uma issue][issue]! De verdade! Não perde tempo não.

# O que realmente é isso? (Um pouco de história)

Este repositório acompanha uma [apresentação][] dada a um evento para o
pessoal do [HotelUrbano][], introduzindo um pouco o conceito de [TDD][]
para (pelo menos tentar) mostrar como ciclos e o produto de TDD pode
ser. Este repositório é o produto disso.

Sinta-se livre pra *clonar*, *mudar* ou *usar* alguma coisa deste repositório.
Assim como para nos contactar sobre qualquer coisa relacionada a ele. Inclusive
possíveis contatos imediatos de terceiro grau que possam vir a ocorrer caso
você decida instalar ele em sua máquina.

PS: não nos responsabilizamos por nenhuma atividade alienígena.

## Como você deve ver este repositório?

Além de, obviamente, instalar, testar e modificar a aplicação; veja a história
dos [commits][] e tente fazer o [checkout][] deles rodando as suites de teste
em cada.

Se isso não te soar interessante o suficiente, preparamos algumas [issues][issue]
para você! Tente fazer uma usando TDD!

Se nada disso te interessar, tire uma foto usando uma gravata borboleta e nos
envie!

[composer]: https://getcomposer.org/ "Composer: Package Management for PHP"
[behat]: http://behat.org/ "Behat: Behavior Driven Development Franework for PHP"
[phpunit]: http://phpunit.de/ "PHPUnit: The PHP Testing Framework"
[gravatar]: https://secure.gravatar.com/ "Gravatar: Globally Recognized Avatars"
[git]: http://git-scm.com/ "Git - Source Code Management"
[virtualbox]: https://www.virtualbox.org/wiki/Downloads "VirtualBox: Downloads"
[vagrant]: http://www.vagrantup.com/downloads.html "Vagrant: Downloads"
[apresentação]: http://www.slideshare.net/augustopascutti/tdd-test-driven-development-em-php
[TDD]: https://en.wikipedia.org/wiki/Test-driven_development "Wikipedia: Test Driven Development"
[HotelUrbano]: http://techtalks.hotelurbano.com/ "HU Tech Talk 2014"
[vm]: https://en.wikipedia.org/wiki/Virtual_machine "Wikipedia: Virtual Machine"
[ssh]: https://en.wikipedia.org/wiki/Secure_Shell "Wikipedia: Secure Shell"
[ubuntu]: http://ubuntu.com "Ubuntu: The world's most popular free Operating System"
[1]: http://docs.vagrantup.com/v2/installation/index.html "Vagrant - Documentation: Installation"
[2]: http://www.tecmundo.com.br/sistema-operacional/5214-como-editar-os-arquivos-hosts-do-computador-.htm "TecMundo: Como editar os arquivos de host do computador"
[checkout]: http://git-scm.com/docs/git-checkout "Git Documentation: git-checkout"
[issue]: http://github.com/augustohp/gravata/issues
[commits]: http://github.com/augustohp/gravata/commits/master
