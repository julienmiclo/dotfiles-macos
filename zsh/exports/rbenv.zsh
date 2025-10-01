eval "$(rbenv init - --no-rehash zsh)"
FPATH=~/.rbenv/completions:"$FPATH"
autoload -U compinit
compinit
