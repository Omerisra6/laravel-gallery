import { _ } from "../utils/helpers.js"

const inputSearchAd      = _('.input-search')
const searchAdButton     = _('.search-ads')

attachListenersOnSearch()

function attachListenersOnSearch() 
{
    searchAdButton.addEventListener('click', function() {
        searchAdsFnc()
    })
}

function searchAdsFnc(){    
    window.location = `/search/?value=${inputSearchAd.value}`
}