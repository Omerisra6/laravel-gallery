const selectVideoButton  = _('.select-video')
const openFileExplorer   = _('.video-upload')
const titleInput         = _('.title-input')
const projectNumberInput = _('.project-number-input')
const descriptionInput   = _('.description-input')
const madeForInput       = _('.made-for-input')
const sumbitForm         = _('.sumbit-upload-form')
const fillFields         = _('.fill-fields')
const hiddenFileInput    = _('.filepond--data')
const keyWordInput       = _('.key-words-input')
const keyWordsContainer  = _('.key-words-container')
const loading            = _('.loading-container')
const videosTable        = _('.table-body')
const storeVideosForm    = _( '.store-videos-form' )


createFirstFilepond()
attachDefaultListeners()

function createFirstFilepond()
{
    const filePondInput = storeVideosForm.querySelector( 'input[type="file"]' )
    createFilePond( filePondInput )
}

let rowCount = 1

attachListenersOnUploadForm()

function attachListenersOnUploadForm() {
    
    sumbitForm.addEventListener('click', async function( e ){
        e.preventDefault()
        validateInputs()
        await uploadVideo()
    })

}

async function uploadVideo() 
{    
    const videosFormData = appendFilepondsToForm( storeVideosForm ) 
    const requestHeaders = { "Accept": "application/json" }

    try {
        loader.classList.toggle( 'invisible' )
        cleanErrors( storeVideosForm )
        await fetchWrapper( '/video', 'POST', requestHeaders, videosFormData )    
    } catch ( errors ) {
        loader.classList.toggle( 'invisible' )    
        renderErrors( errors, storeVideosForm )
        return
    }   
    window.location.href = '/'
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

    rowCount++

    //showing the user the next row
    const nextRow = _(`[data-row="${rowCount}"]`)

    nextRow.classList.toggle('invisible')
    nextRow.classList.toggle('visible-row')

}

function removeRow() {
    
    if (rowCount == 1) {

        fillFields.innerHTML = 'minimum one project required'
        fillFieldsPop()
        return
    }

    //showing the user the next row
    const nextRow = _(`[data-row="${rowCount}"]`)

    nextRow.classList.toggle('invisible')
    nextRow.classList.toggle('visible-row')

    const inputs = nextRow.querySelectorAll('input')
    
    inputs.forEach(input => {
        input.value = ''
    });

    rowCount--  

}

function copyRow(e) {

    const row = e.currentTarget.parentElement.parentElement

    //getting the inputs from the row
    const title         = row.querySelector('.title-input').value
    const projectNumber = row.querySelector('.project-number-input').value
    const description   = row.querySelector('.description-input').value
    const madeFor       = row.querySelector('.made-for-input ').value
    const keyWords      = row.querySelector('.key-words-input').value

    //adding the row
    addRow()

    //filling the row with the conten
    fillNextRow( title, projectNumber, description, madeFor, keyWords)
    
}

function fillNextRow( title, projectNumber, description, madeFor, keyWords) {

    const row = _(`[data-row="${rowCount}"]`)

   
    row.querySelector('.title-input').value          = title
    row.querySelector('.project-number-input').value = projectNumber
    row.querySelector('.description-input').value    = description
    row.querySelector('.made-for-input ').value      = madeFor
    row.querySelector('.key-words-input').value      = keyWords
}

function fillFieldsPop() {

    fillFields.classList.remove('invisible')
    
    //removing the pop after secs
    setTimeout( () => {
        
        fillFields.classList.add('invisible')
    
    }, 3000) 
    
}