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

    <form class="import-videos-container nav-button" action="/import" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept="file/xlxs" class="invisible">
        <button class="sumbit-excel invisible">Submit</button>
        <i class="fa-brands fa-google-drive import-icon"></i>
    </form>
</div>