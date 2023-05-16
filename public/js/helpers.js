const _All = ( selector ) => { 
    
    return document.querySelectorAll( selector ) 
}

function appendArrayToForm( form, name, arr ){
    
    arr.forEach( key => {

        form.append( `${name}[]`, key )
    });

    return form
}

function appendExtraDataToArray( formData, arrayName, inputsNode ) 
{
    console.log( [ ...inputsNode ] );
    [ ...inputsNode ].forEach( ( input, index ) => {

        formData.append( `${ arrayName }[${ index }][${ input.name }]`, input.value )
    })    

    return formData
}