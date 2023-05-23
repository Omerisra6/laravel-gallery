export const _ = ( selector ) => { 
    
    return document.querySelector( selector ) 
}

export const _All = ( selector ) => { 
    
    return document.querySelectorAll( selector ) 
}

export function appendArrayToForm( form, name, arr ){
    
    arr.forEach( key => {

        form.append( `${name}[]`, key )
    });

    return form
}

export function appendExtraDataToArray( formData, arrayName, inputsNode ) 
{
    Array.from( inputsNode ).forEach( ( input, index ) => {

        formData.append( `${ arrayName }[${ index }][${ input.name }]`, input.value )
    })    

    return formData
}

export function renderErrors( data, form ) 
{
    const errors    = data.errors
    const errorKeys = Object.keys( errors )

    //Render errors
    errorKeys.forEach( errorKey => {
        const errorContainer =  form.querySelector( `[name="errors-${errorKey}"]` )
        errors[ errorKey ].forEach( message => {
            errorContainer.innerHTML = message
        })
    })
}

export function deleteErrors( form )
{
    const errors = form.querySelectorAll( '.error' )

    errors.forEach( error => error.innerHTML = '' )
}

export async function fetchWrapper(url, method = "GET", headers = {}, body = null) {

    const csrf = _('.search-container').dataset.csrf
    headers[ 'X-CSRF-TOKEN' ] = csrf
    const response = await fetch(url, {
        headers,
        method,
        body,
    });
  
    const json = await response.json();
    return response.ok ? json : Promise.reject(json);
}

export function toggleOnSelect( elementsList, selectedElement, className )
{
    Array.from( elementsList ).forEach((element) => {
        const isSelected = element === selectedElement;
        element.classList.toggle(className, isSelected);
    });
}