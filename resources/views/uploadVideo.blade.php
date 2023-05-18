@extends( 'layouts.app' )
@section( 'styles' )    
    <link href="{{ url('/css/loader.css') }}" rel="stylesheet"/>
    <link href="{{ url('/css/addVideo.css') }}" rel="stylesheet"/>
@endsection

  
@section( 'content' )       
    <x-loader></x-loader>
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
    
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
@endsection

@section( 'after-content' )
    <x-loader></x-loader>
@endsection

@section( 'scripts' )
    <script type="module" src="{{ asset('js/uploadVideo.js') }}" ></script>
@endsection