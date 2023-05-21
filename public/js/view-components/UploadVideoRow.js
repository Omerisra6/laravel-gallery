import { createFilePond } from "../utils/filepond.js"

export const UploadVideoRow = ( index ) =>{

    const videoRowElement = document.createElement( 'tr' )
    videoRowElement.classList.add( 'row' )

    videoRowElement.innerHTML = `
        <td class="count">
            ${index}
        </td>
        <td> 
            <div class="error" name="errors-videos.${index}.title"></div>
            <input  type="text" name="videos[${index}][title]" class="title-input upload-input" autocomplete="off" placeholder="Give me a title"  focus="none"> 
        </td>

        <td> 
        <div class="error" name="errors-videos.${index}.project_number"></div>
            <input  type="text" name="videos[${index}][project_number]" autocomplete="off" class="project-number-input upload-input" placeholder="Give me project number" >
        </td>

        <td>
            <div class="error" name="errors-videos.${index}.description"></div>
            <input  type="text" name="videos[${index}][description]"  autocomplete="off" class="description-input textra" placeholder="Give me a descripion (optional)"></input>
        </td>

        <td>            
            <div class="error" name="errors-videos.${index}.made_for"></div>
            <input  type="text" name="videos[${index}][made_for]" autocomplete="off" class="made-for-input upload-input"  placeholder="Give me a client name">
        </td>

        <td>
            <div class="error" name="errors-videos.${index}.key_words"></div>
            <input  type="text" name="videos[${index}][key_words]" autocomplete="off" class="key-words-input upload-input" placeholder="Give me a key word"><br/>
        </td>

        <td>
            <div class="error" name="errors-videos.${index}.video"></div>
            <div class="filepond-container">
                <input class="ad-file-input" type="file" accept="video/mp4,video/x-m4v,video/*, video/mov" name="video">
            </div>
        </td>
    `

    const filePondInput = videoRowElement.querySelector( '.ad-file-input')
    createFilePond( filePondInput )

    return videoRowElement
}