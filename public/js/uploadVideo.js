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

async function validateInputs(){
    

    const tableRows = document.querySelectorAll('.visible-row')
    let isValid = true

    //checks if the required inputs full
    tableRows.forEach( element => {

        const file          = element.querySelector('.filepond--data')
        console.log( file.querySelector('input[name="video"]') );

        if ( ! element.querySelector('.title-input').value) {

            fillFields.innerHTML = 'Please fill all title fields'
            fillFieldsPop()
            isValid = false
            return
        }

        if ( ! element.querySelector('.project-number-input').value) {

            fillFields.innerHTML = 'Please fill all project number fields'
            fillFieldsPop()
            isValid = false
            return
        } 
        
        if ( ! element.querySelector('.key-words-input').value) {

            fillFields.innerHTML = 'Please fill all key words fields'
            fillFieldsPop()
            isValid = false
            return
        } 
        
        if ( ! element.querySelector('.made-for-input').value) {
            
            fillFields.innerHTML = 'Please fill all client fields'
            fillFieldsPop()
            isValid = false
            return
        }

        if ( ! file.querySelector('input[name="video"]') ) {

            fillFields.innerHTML = 'Please fill all files fields'
            fillFieldsPop()
            isValid = false
            return
        }

       
        
    })

    if (! isValid){
        return
    }
}

async function uploadVideo() {
    
    let videosFormData = new FormData( storeVideosForm )
    const filePonds    = _All( '.filepond--data' )
    const fileInputs   = [ ...filePonds ].map( ( filePond ) =>{
        
        return filePond.querySelector( 'input[name="video"]' );
    }).filter( (value ) => !! value )
    
    videosFormData = appendExtraDataToArray( videosFormData, 'videos', fileInputs )

    const upload =  await fetch('/video', {
        method: 'POST',
        headers: {                
            "X-CSRF-TOKEN": csrf,
            "Accept": "application/json"
            },
        body: videosFormData,
    }).then( res => res.json() ).then( data => {
        
        
       console.log( data );
    })
    
}

function _( element ) {

    return document.querySelector( `${element}` )
}

function addRow(){

    //max 25 rows
    if (rowCount == 25) {

        fillFields.innerHTML = 'maximum 25 projects'
        fillFieldsPop()
        return
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