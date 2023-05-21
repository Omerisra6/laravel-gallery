import { _, _All } from "../utils/helpers.js"
import { setUpPagination } from "../utils/pagination.js"

const downloadPop         = _('.download-pop-container')
const originalDownload    = _('.download-original-video')
const reducedDownload     = _('.download-reduced-video')
const closePopIcon        = _( '.close-download-pop' )

attachDefaultListeners()

function attachDefaultListeners()
{
    setUpPagination( addDownloadButtonsListeners )

    closePopIcon.addEventListener( 'click', () =>{ 

        downloadPop.classList.toggle( 'invisible' )
    })
}

function addDownloadButtonsListeners()
{
    const videoDownloadButtons = _All( '.download-video-button')

    Array.from( videoDownloadButtons ).forEach( downloadButton => {

       downloadButton.addEventListener( 'click', ( e ) => showDownloadPop( e ) )
    })
}

function showDownloadPop( e ) 
{
    const videoId = e.currentTarget.dataset.vid

    originalDownload.href = `api/video/${ videoId }`
    reducedDownload.href  = `api/reduced_video/${ videoId }`

    downloadPop.classList.toggle( 'invisible' )    
}