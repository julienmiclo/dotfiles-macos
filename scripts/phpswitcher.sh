#!/bin/bash

brew_prefix=$(brew --prefix)
opt_path="$brew_prefix/opt/"
apache_conf_path="/Users/julienmiclo/.dotfiles/httpd/custom/001-loadmodules.conf"

php_version="php"
php_module="php_module"
module_name="libphp"
#apache_php_lib_path="/lib/httpd/modules/libphp.so"

if [ "$1" == "8.2" ]
then
 	php_version="php@8.2"	
elif [ "$1" == "8.1" ]
then
        php_version="php@8.1"
elif [ "$1" == "8.0" ]
then
	php_version="php@8.0"
elif [ "$1" == "7.4" ]
then
	php_module="php7_module"
	php_version="php@7.4"
	module_name="libphp7"
elif [ "$1" == "5.6" ]
then
	php_module="php5_module"
	php_version="php@5.6"
	module_name="libphp5"
fi


apache_php_mod_path="/opt/homebrew/opt/$php_version/lib/httpd/modules/$module_name.so"


for v in `ls /opt/homebrew/opt/ | grep php | cut -c4-8 | uniq`; do
	brew unlink php$v > /dev/null
done
brew link "$php_version" --force --overwrite

php -v

sed -i '' -e '$ d' $apache_conf_path
echo "LoadModule $php_module $apache_php_mod_path" >> $apache_conf_path

brew services restart httpd -d -v && brew services restart php -d -v

brew services

exit
