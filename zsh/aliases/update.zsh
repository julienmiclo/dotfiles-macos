alias update-shit="update-brew && update-sym && update-pnpm && update-flutter"

alias update-brew="brew update && brew outdated && brew upgrade && brew cleanup"
alias update-sym="symfony self:update"
alias update-pnpm="pnpm up --global && pnpm link --global"
alias update-yarn="yarn global upgrade && yarn cache clean"
alias update-flutter="flutter upgrade"
