@extends( 'layouts.app' )
@section( 'styles' )    
    <link href="{{ url('/css/loader.css') }}" rel="stylesheet"/>
    <link href="{{ url('/css/components/filepond.css') }}" rel="stylesheet"/>
    <link href="{{ url('/css/addVideo.css') }}" rel="stylesheet"/>
@endsection

  
@section( 'content' )       
    <div class="upload-form-container">
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
                <tbody class="videos-table-body">

                    <tr class="row visible-row" data-row="1">
                        <td class="count">
                            <div class="error"></div>
                            <div class="count-number">1</div>
                        </td>
                        <td> 
                            <div class="error" name="errors-videos.0.title"></div>
                            <input  type="text" name="videos[0][title]" class="title-input upload-input" autocomplete="off" placeholder="Type a title"  focus="none" required> 
                        </td>

                        <td> 
                        <div class="error" name="errors-videos.0.project_number"></div>
                            <input  type="text" name="videos[0][project_number]" autocomplete="off" class="project-number-input upload-input" placeholder="Type project number"  required>
                        </td>

                        <td>
                            <div class="error" name="errors-videos.0.description"></div>
                            <input  type="text" name="videos[0][description]"  autocomplete="off" class="description-input textra" placeholder="Type a descripion"></input>
                        </td>

                        <td>            
                            <div class="error" name="errors-videos.0.made_for"></div>
                            <input  type="text" name="videos[0][made_for]" autocomplete="off" class="made-for-input upload-input"  placeholder="Type a client name" required>
                        </td>

                        <td>
                            <div class="error" name="errors-videos.0.key_words"></div>
                            <input  type="text" name="videos[0][key_words]" autocomplete="off" class="key-words-input upload-input" placeholder="Type key words" required><br/>
                        </td>

                        <td>
                            <div class="error" name="errors-videos.0.video"></div>
                            <div class="filepond-container">
                                <input class="ad-file-input" type="file" accept="video/mp4,video/x-m4v,video/*, video/mov" name="video" required>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </form>
         <div class="page-bottom">

            <div class="rows-buttons-container">

                <button class="remove-row-button"><i class="fa fa-minus"></i></button>
                <button class="add-row-button"><i class="fa fa-plus"></i></button>

            </div>

            <button class="submit-upload-form theme-color" >Upload All</button>

        </div>
    </div>
    
    
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
@endsection

@section( 'after-content' )
    <x-loader></x-loader>
@endsection

@section( 'scripts' )
    <script type="module" src="{{ asset('js/pages/uploadVideo.js') }}" ></script>
@endsection