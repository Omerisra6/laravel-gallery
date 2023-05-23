import { _All } from "../utils/helpers.js";

const navButtons = _All( '.nav-button' )

setCurrentNavLocation()

function setCurrentNavLocation()
{
    let currentButton = Array.from( navButtons ).find( ( navButton ) => { return navButton.href === window.location.href })
    
    currentButton       = currentButton ?? navButtons[ 0 ]
    const navIcon       = currentButton.querySelector( 'i' )
    navIcon.style.color = 'var( --theme-green-text )'
}