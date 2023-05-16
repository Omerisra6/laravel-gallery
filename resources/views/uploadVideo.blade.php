    <!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ea6d546e2a.js" crossorigin="anonymous"></script>
    <link href="{{ url('/css/header.css') }}" rel="stylesheet"/>
    <link href="{{ url('/css/welcome.css') }}" rel="stylesheet"/>
    <link href="{{ url('/css/loader.css') }}" rel="stylesheet"/>
    <link href="{{ url('/css/addVideo.css') }}" rel="stylesheet"/>



</head>


<html>

    <body>
        
       
        <div>
            <div class="loading-container invisible">
            <div class="lds-roller loading-upload"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>

        @include('layouts.header') 
        
        <form class="store-videos-form" action="{{ route( 'store_video' ) }}" method="post">

            <table class="upload-video-container">
                <thead>
                    <tr class="table-head">
                        <th class="count-head"></th>
                        <th>Project Name</th>
                        <th>Project Number</th>
                        <th>Description</th>
                        <th>Client</th>
                        <th>Key Words</th>
                        <th class="file-th">File</th>
                    </tr>
                </thead>
                <tbody class="table-body">

                    <tr class="row visible-row" data-row="1">
                        <td class="count">
                            <div class="copy-container" onclick="copyRow(event)">
                                <i class="fa fa-copy theme-color"></i>                        
                            </div>


                            1
                        </td>
                        <td> 
                            <input  type="text" name="videos[0][title]" class="title-input upload-input" autocomplete="off" placeholder="Give me a title"  focus="none" required> 
                        </td>

                        <td> 
                            <input  type="text" name="videos[0][project_number]" autocomplete="off" class="project-number-input upload-input" placeholder="Give me project number"  required>
                        </td>

                        <td>
                            <input  type="text" name="videos[0][description]"  autocomplete="off" class="description-input textra" placeholder="Give me a descripion (optional)"></input>

                        </td>

                        <td>            
                            <input  type="text" name="videos[0][made_for]" autocomplete="off" class="made-for-input upload-input"  placeholder="Give me a client name" required>
                        </td>

                        <td>
                            
                            <input  type="text" name="videos[0][key_words]" autocomplete="off" class="key-words-input upload-input" placeholder="Give me a key word" required><br/>
                            
                        </td>

                        <td>
                            <div class="filepond-container">
                                <input class="ad-file-input" type="file" accept="video/mp4,video/x-m4v,video/*, video/mov" name="video" required>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>

            <div class="fill-fields invisible"></div>

            <div class="page-bottom">

                <button class="remove-row" onclick="removeRow()">Remove Row</i></button>

                <button class="sumbit-upload-form theme-color" >Upload Ad</button>
        
                <button class="add-row" onclick="addRow()">Add Row</button>

                
            </div>

        </form>
        
        
            <!-- <h6 class="fill-fields"></h6>

            <input type="text" name="title" class="title-input upload-input" autocomplete="off" placeholder="Give me a title"   focus="none" required> 

            <input type="text" name="project_number" autocomplete="off" class="project-number-input upload-input" placeholder="Give me project number"  required><br/>
            <div class="filepond-container">
                <input  type="file" accept="video/mp4,video/x-m4v,video/*, video/mov" name="video" required>
            </div>
           

            <input type="text" name="description"  autocomplete="off" class="description-input textra" placeholder="Give me a descripion (optional)"></input>

            <input type="text" name="made_for" autocomplete="off" class="made-for-input upload-input"  placeholder="Give me a client name" required><br/>
            
            <div class="add-key-word-container">
                <input type="text" name="key_words" autocomplete="off" class="key-words-input upload-input" placeholder="Give me a key word" required><br/>
                <button class="add-key-word" onClick="addKeyWord()"><i class="fa fa-plus theme-color"></i></button>
            </div>
            

            <div class="key-words-container">
            </div>

    
            <button class="sumbit-upload-form theme-color">Upload Ad</button>
             -->
        
            

        
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

        
        
    </body>
    <script>
        // Get a reference to the file input element
        const inputElement = document.querySelectorAll('input[type="file"]');

        // Create a FilePond instance
        Array.from(inputElement).forEach(inputElement => {

            // create a FilePond instance at the input element location
            const pond = FilePond.create(inputElement);

            pond.setOptions({
            server:{

                url : '/api/upload',
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                remove: (source, load, error) => {
                    // Should somehow send `source` to server so server can remove the file with this source
                    const remove = fetch ( `/api/remove/${ source }` ,{
                        method: 'GET',
                        headers: {                
                            "X-CSRF-TOKEN": '{{ csrf_token() }}',
                            },
                        })


                        // Should call the load method when done, no parameters required
                        load();
                    },
                }
            });

        })

       
        

    </script>

    <script src="{{ asset( 'js/helpers.js' ) }}"></script>
    <script type="text/javascript" src="{{ asset('js/uploadVideo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/header.js') }}"></script>
    
    
    

</html>





