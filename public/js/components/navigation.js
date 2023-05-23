import { _, _All, fetchWrapper } from "../utils/helpers.js";

const navButtons         = _All( '.nav-button' )
const importIcon         = _( '.import-icon' )
const importVideosInput = _( '.import-videos-input' )
const importVideosForm   = _( '.import-videos-form' )

attachDefaultListeners()

function attachDefaultListeners()
{
    setCurrentNavLocation()

    importIcon.addEventListener( 'click', () => importVideosInput.click() )

    importVideosInput.addEventListener( 'change', async() => await sendImportRequest() )
}

function setCurrentNavLocation()
{
    let currentButton = Array.from( navButtons ).find( ( navButton ) => { return navButton.href === window.location.href })
    
    currentButton       = currentButton ?? navButtons[ 0 ]
    const navIcon       = currentButton.querySelector( 'i' )
    navIcon.style.color = 'var( --theme-green-text )'
}

async function sendImportRequest() 
{
    const videosFormData = new FormData( importVideosForm )

    try {
        await fetchWrapper( '/import', 'POST', {}, videosFormData )
    } catch (error) {
        console.log( error );
    }    
}