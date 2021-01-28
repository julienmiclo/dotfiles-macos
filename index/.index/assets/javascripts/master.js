const repositories = document.querySelectorAll('.wrap-repository')
const searchContainer = document.querySelector("#searchContainer")
const searchInput = document.querySelector("#searchInput")
const searchClear = document.querySelector("#searchClear")
const addBookmark = document.querySelector("#actionBookmark")
let searchTimeout = null

searchInput.addEventListener("input", (e) => {
    const search = e.target.value

    doSearch(search)
})

searchInput.addEventListener("focus", (e) => {
    const search = e.target.value

    doSearch(search)
})

searchClear.addEventListener("click", () => {
    clearTimeout(searchTimeout)
    searchInput.value = ""
    searchContainer.classList.remove("loading")
    searchContainer.classList.remove("clear-input")
    repositories.forEach((repo) => {
        repo.classList.remove('hidden')
    })
})

repositories.forEach((repo) => {
    repo.addEventListener("click", (e) => {
        const element = e.target
        if(element.getAttribute('id') === "actionBookmark"){
            e.preventDefault()
            
            const parent = e.currentTarget
            let classList = element.classList
            let values = (localStorage.getItem('repositories') === null)?[]:JSON.parse(localStorage.getItem('repositories'))
            let name = parent.dataset.name

            if(classList.contains('booked')){
                classList.remove('booked')
                const name_index = values.indexOf(name);
                if(name_index >= 0){
                    values.splice(name_index,1);
                }
            }else {
                classList.add('booked')
                values.push(name)
            }

            localStorage.setItem('repositories', JSON.stringify(values))

            return false
        }
    })
})

const data = JSON.parse(localStorage.getItem('repositories'))
if(data){
    data.forEach((d) => {
        let repo = document.querySelector(`.wrap-repository[data-name="${d}"] #actionBookmark`)
        repo.classList.add('booked')
    })
}


function doSearch(search){
    if(!(search.length === 0 || !search.trim())){
        searchContainer.classList.add("loading")
        searchContainer.classList.add("clear-input")
    }

    clearTimeout(searchTimeout)
    searchTimeout = setTimeout(() => {

        if(repositories){
            let regexp = `^(.*)(${search.trim()})(.*)$`
            regexp = new RegExp(regexp, 'i')
            repositories.forEach((repo) => {
                const matches = repo.dataset.name.match(regexp)
                repo.classList.remove('hidden')

                if(matches === null){
                    repo.classList.add('hidden')
                }
            })

            searchContainer.classList.remove("loading")
        }
    }, 500)
}
