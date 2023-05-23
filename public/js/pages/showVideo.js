import { _, _All, toggleOnSelect } from "../utils/helpers.js"

const detailOptions = _All( '.detail-option' )

attachDefaultListeners()

function attachDefaultListeners()
{
    Array.from( detailOptions ).forEach( ( detailOption ) => {
        detailOption.addEventListener( 'click', ( e ) => handleOptionChange( e ) )
    } )
}

function handleOptionChange(e) {
    const selectedOption = e.currentTarget;
  
    if (selectedOption.classList.contains('selected-option')) {
      return;
    }
  
    const detailOptions = _All('.detail-option');
    toggleOnSelect( detailOptions, selectedOption, 'selected-option' )

    const detailsContents       = _All( '.detail-content' ) 
    const detailContentClass    = selectedOption.dataset.for
    const selectedDetailContent = _( `.${ detailContentClass }`)
    console.log( detailsContents, selectedDetailContent, detailContentClass )
    toggleOnSelect( detailsContents, selectedDetailContent, 'visible' )
}
  