alias check-server="apachectl configtest && brew services"
alias restart-server="brew services restart httpd && brew services restart php && brew services restart mysql && brew services"
alias start-server="brew services start httpd && brew services start php && brew services start mysql"
alias stop-server="brew services stop php && brew services stop httpd && brew services stop mysql"
