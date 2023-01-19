alias ..="cd .."
alias ld="ls"
alias ll="ls -lah --color=auto --group-directories-first"
alias l="ls -CF"
alias c="clear"

alias mv="mv -i"
for c in cp rm chmod chown rename; do
	alias $c="$c -v"
done

alias v="vim -R -"
for i in /usr/share/vim/vim*/macros/less.sh(N); do
	alias v="$i"
done

alias home="cd ~"
alias dotfiles="cd ~/.dotfiles"

alias weather="curl wttr.in/nancy"

alias whois="whois -h geektools.com"
alias scp="scp -C -p"
alias screen="screen -U"
alias x="screen -A -x"
alias r="screen -D -R"

alias python="python3"

alias wppst="open -a 'phpstorm.app' ./wp-content/themes"

alias myip="curl https://ipecho.net/plain"
