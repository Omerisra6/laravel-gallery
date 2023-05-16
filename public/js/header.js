const inputSearchAd      = _('.input-search')
const searchAdButton     = _('.search-ads')
const checkedCategory    = _('.selected-option')
const searchOptions      = _('.serach-options-container')
const downloadPop        = _('.download-pop-container')
const originalDownload   = _('.download-original-video')
const reducedDownload    = _('.download-reduced-video')

const csrf               = _('.search-container').dataset.csrf


//the category that was used for the search
let currentCategory = 'title'

//the category that will posibly be used for the next search
let nextCategory = 'title'

let pageCount = 1


attachListenersOnSearch()



function attachListenersOnSearch() {

    searchAdButton.addEventListener('click', function() {

        searchAdsFnc()

    })

}

function searchAdsFnc(){    
    window.location = `/search/?value=${inputSearchAd.value}`
}


function showDownload(e) {

    //getting video id and setting the links for download
    const videoId = e.currentTarget.dataset.vid

    originalDownload.href = `api/video/${videoId}`
    reducedDownload.href = `api/reduced_video/${videoId}`

    downloadPop.classList.toggle('invisible')
    
}

//unshows download pop
function closeDownload() {

    downloadPop.classList.toggle('invisible')

}

function printFile(fileId) {

    var request = gapi.client.drive.files.get({
      'fileId': fileId
    });

    request.execute(function(resp) {
      console.log('Title: ' + resp.title);
      console.log('Description: ' + resp.description);
      console.log('MIME type: ' + resp.mimeType);
    });
  }

function _( element ) {

    return document.querySelector( element )
}