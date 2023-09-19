if [[ -s "${ZDOTDIR:-$HOME}/.zprezto/init.zsh" ]]; then
	source "${ZDOTDIR:-$HOME}/.zprezto/init.zsh"
fi

for file in ${ZDOTDIR:-$HOME}/.dotfiles/zsh/aliases/*.zsh; do
	source $file
done

for file in ${ZDOTDIR:-$HOME}/.dotfiles/zsh/exports/*.zsh; do
	source $file
done

#for file in ${ZDOTDIR:-$HOME}/.dotfiles/zsh/plugins/*.zsh; do
#	source $file
#done


export PNPM_HOME="/Users/julienmiclo/Library/pnpm"
export PATH="$PNPM_HOME:$PATH"


export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"  # This loads nvm
[ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion"  # This loads nvm bash_completion

source /Users/julienmiclo/.docker/init-zsh.sh || true # Added by Docker Desktop
