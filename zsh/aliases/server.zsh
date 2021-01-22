alias server-check="apachectl configtest && brew services"
alias server-restart="brew services restart httpd && brew services restart php && brew services"
alias server-start="brew services start httpd && brew services start php"
alias server-stop="brew services stop php && brew services stop httpd"

alias php74="sh ~/.scripts/phpswitcher.sh 7.4"
alias php8="sh ~/.scripts/phpswitcher.sh 8.0"
