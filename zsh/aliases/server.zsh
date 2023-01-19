alias server-check="apachectl configtest && brew services"
alias server-restart="brew services restart httpd && brew services restart php && brew services"
alias server-start="brew services start httpd && brew services start php"
alias server-stop="brew services stop php && brew services stop httpd"

alias php74="sh ~/.scripts/phpswitcher.sh 7.4"
alias php80="sh ~/.scripts/phpswitcher.sh 8.0"
alias php81="sh ~/.scripts/phpswitcher.sh 8.1"

