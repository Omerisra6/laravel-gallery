<div class="navigation-container">

    <a class="logo-container" href="/">
        <img src="/images/logo.jpg" alt="" class="logo" >
    </a>

    <a class="home-container nav-button" href="/">
        <i class="fa fa-home home-icon"></i>
    </a>

    <a class="add-video-container nav-button" href="/addVideo">
        <i class="fa-solid fa-upload"></i>
    </a>

    <form class="import-videos-container import-videos-form nav-button" action="/import" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="import-videos-input invisible" type="file" name="file" accept="file/xlxs">
        <i class="fa-brands fa-google-drive import-icon"></i>

        <div class="drive-explanation">
            <h4 class="explanation-title">Read before using</h4>
            <span class="drive-explanation-text">
                This method allows for synchronizing video details from Google Drive using an Excel file. 
                </br>
                It requires that the files in storage have the exact same name as the corresponding Google Drive files. 
                </br>
            </span>
            <a href="{{asset('files/Gravity-Drive-Test.xlsx')}}" class="excel-sample-download link" download>Excel Sample</a>
        </div>
    </form>
</div>