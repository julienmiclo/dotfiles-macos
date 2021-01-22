#!/bin/bash

brew_prefix=$(brew --prefix | sed 's#/#\\\/#g')
opt_path="$brew_prefix\/opt\/"
apache_conf_path="~/.dotfiles/httpd/custom/001-loadmodules.conf"

cat $apache_conf_path 
exit

php_version="php"
php_module="php_module"
apache_php_lib_path="\/lib\/httpd\/modules\/libphp.so"


if [[ "$1" == "7.4" ]]; then
 	php_version="php@7.4"
	php_module="php7_module" 
	apache_php_lib_path="\/lib\/httpd\/modules\/libphp7.so"
elif [[ "$1" == "8.0" ]]; then
 	php_version="php@8.0"	
fi


apache_php_mod_path="$opt_path$php_version$apache_php_lib_path"

for v in `ls /opt/homebrew/opt/ | grep php | cut -c4-8 | uniq`; do
	brew unlink php$v > /dev/null
done
brew link --force "$php_version"


sudo sed -i.bak "s/\#LoadModule $php_module $apache_php_mod_path/LoadModule $php_module $apache_php_mod_path/g" $apache_conf_path

brew services restart httpd && brew services restart php

brew services

exit
