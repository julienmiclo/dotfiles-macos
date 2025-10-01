if [[ -s "${ZDOTDIR:-$HOME}/.zprezto/init.zsh" ]]; then
	source "${ZDOTDIR:-$HOME}/.zprezto/init.zsh"
fi

for file in ${ZDOTDIR:-$HOME}/.dotfiles/zsh/aliases/*.zsh; do
	source $file
done

for file in ${ZDOTDIR:-$HOME}/.dotfiles/zsh/exports/*.zsh; do
	source $file
done

# bun completions
[ -s "/Users/julienmiclo/.bun/_bun" ] && source "/Users/julienmiclo/.bun/_bun"
