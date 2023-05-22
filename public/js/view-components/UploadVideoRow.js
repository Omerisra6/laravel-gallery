import { createFilePond } from "../utils/filepond.js"

export const UploadVideoRow = ( index ) =>{

    const videoRowElement = document.createElement( 'tr' )
    videoRowElement.classList.add( 'row' )

    videoRowElement.innerHTML = `
        <td class="count">
            <div class="error"></div>
            <div class="count-number">${index + 1}</div>
        </td>
        <td> 
            <div class="error" name="errors-videos.${index}.title"></div>
            <input  type="text" name="videos[${index}][title]" class="title-input upload-input" autocomplete="off" placeholder="Type a title"  focus="none" required> 
        </td>

        <td> 
        <div class="error" name="errors-videos.${index}.project_number"></div>
            <input  type="text" name="videos[${index}][project_number]" autocomplete="off" class="project-number-input upload-input" placeholder="Type project number"  required>
        </td>

        <td>
            <div class="error" name="errors-videos.${index}.description"></div>
            <input  type="text" name="videos[${index}][description]"  autocomplete="off" class="description-input textra" placeholder="Type a descripion"></input>
        </td>

        <td>            
            <div class="error" name="errors-videos.${index}.made_for"></div>
            <input  type="text" name="videos[${index}][made_for]" autocomplete="off" class="made-for-input upload-input"  placeholder="Type a client name" required>
        </td>

        <td>
            <div class="error" name="errors-videos.${index}.key_words"></div>
            <input  type="text" name="videos[${index}][key_words]" autocomplete="off" class="key-words-input upload-input" placeholder="Type key words" required><br/>
        </td>

        <td>
            <div class="error" name="errors-videos.${index}.video"></div>
            <div class="filepond-container">
                <input class="ad-file-input" type="file" accept="video/mp4,video/x-m4v,video/*, video/mov" name="video" required>
            </div>
        </td>
    `

    const filePondInput = videoRowElement.querySelector( '.ad-file-input')
    createFilePond( filePondInput )

    return videoRowElement
}