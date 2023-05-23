import { _, _All, appendExtraDataToArray, deleteErrors, fetchWrapper, renderErrors } from "../utils/helpers.js"
import { createFilePond } from "../utils/filepond.js"
import { UploadVideoRow } from "../view-components/UploadVideoRow.js"

const sumbitForm      = _('.submit-upload-form')
const loader          = _('.loading-container')
const storeVideosForm = _( '.store-videos-form' )
const videosTableBody = _( '.videos-table-body' )
const addRowButton    = _( '.add-row-button' )
const removeRowButton = _( '.remove-row-button' )

attachDefaultListeners()

function attachDefaultListeners() 
{    
    createFirstFilepond()
    
    sumbitForm.addEventListener('click', async function( e ){

        e.preventDefault()
        await uploadVideo()
    })

    addRowButton.addEventListener( 'click', ( e ) => addRow( e ) )

    removeRowButton.addEventListener( 'click', ( e ) => removeRow( e ) )
}

function createFirstFilepond()
{
    const filePondInput = storeVideosForm.querySelector( 'input[type="file"]' )
    createFilePond( filePondInput )
}

async function uploadVideo() 
{    
    const videosFormData = appendFilepondsToForm( storeVideosForm ) 
    const requestHeaders = { "Accept": "application/json" }

    try {
        loader.classList.toggle( 'invisible' )
        deleteErrors( storeVideosForm )
        await fetchWrapper( '/video', 'POST', requestHeaders, videosFormData )    
    } catch ( errors ) {
        loader.classList.toggle( 'invisible' )    
        renderErrors( errors, storeVideosForm )
        return
    }   
    window.location.href = '/'
}

function addRow( e )
{
    e.preventDefault()
    const rowIndex = videosTableBody.children.length 
    const videoRowElement = UploadVideoRow( rowIndex )
    videosTableBody.appendChild( videoRowElement )
}

function removeRow( e ) 
{
    e.preventDefault()
    const index = videosTableBody.children.length

    if (index === 1) 
    {
        return
    }

    videosTableBody.removeChild( videosTableBody.lastChild )
}

function appendFilepondsToForm( storeVideosForm )
{
    const videosFormData = new FormData( storeVideosForm )
    const filePonds      = _All( '.filepond--data' )
    const fileInputs     = [ ...filePonds ].map( ( filePond ) =>{
        
        return filePond.querySelector( 'input[name="video"]' );
    }).filter( (value ) => !! value )
    
    return appendExtraDataToArray( videosFormData, 'videos', fileInputs )
}