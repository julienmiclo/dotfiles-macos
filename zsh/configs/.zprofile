typeset -gU cdpath fpath mailpath path

if type brew &>/dev/null; then
    FPATH=$(brew --prefix)/share/zsh-completions:$FPATH
fi

if [ "$ZSH_VERSION" ]; then
    autoload -Uz compinit
    compinit
    autoload bashcompinit
    bashcompinit
fi

path=(
	/usr/local/{bin,sbin}
	$path
)

# Added by OrbStack: command-line tools and integration
source ~/.orbstack/shell/init.zsh 2>/dev/null || :
