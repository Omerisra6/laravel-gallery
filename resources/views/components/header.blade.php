<div class="header">
    <a href="/">
        <img src="/images/logo.jpg" alt="" class="logo" >
    </a>
    <form action="/import" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept="file/xlxs" >
        <button class="sumbit-excel">Sumbit</button>

    </form>
            
    <div class="search-container" data-csrf={{csrf_token()}}>

        <input type="text" required class="input input-search" id="search-id" name="search" placeholder="Searchs ad by key words " autocomplete="off">
        <button class="search-ads"><i class="fa fa-search theme-color"></i></button>

    </div>                

    <a class="upload-video" href="/addVideo">
    <span class="upload-text">Upload Video</span> 
    <i class="fa fa-plus theme-color"></i></a>
</div>
