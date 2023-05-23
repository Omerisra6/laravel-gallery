<h1 align="center">
  <br>
  <a href="https://omerisra6-video-gallery.onrender.com"><img src="https://cdn-icons-png.flaticon.com/512/1160/1160924.png" alt="Video Gallery App" width="200"></a>
  <br>
  <a href="https://omerisra6-video-gallery.onrender.com">Video Gallery App</a>
  <br>
</h1>

<h4 align="center">A Video Gallery App build with <a href="https://laravel.com/" target="_blank">Laravel</a>.</h4>
<p align="center"></p>
<p align="center">
  <a href="#key-features">Key Features</a> •
  <a href="#how-to-use">How To Use</a> •
  <a href="#credits">Credits</a> •
  <a href="#license">License</a>
</p>
<h2 align="center">
  Screenshots
  <br>
  <br>
  <a href="https://omerisra6-video-gallery.onrender.com"><img src="https://i.postimg.cc/q7rrL4Jc/Screen-Shot-2023-05-23-at-19-10-22.png" alt="Screenshot" border="0"></a>
  <br>
  <a href="https://omerisra6-video-gallery.onrender.com"><img src="https://i.postimg.cc/L8c6GVnB/Screen-Shot-2023-05-23-at-18-08-08.png" alt="Screenshot" border="0"></a>
  <br>
  <a href="https://omerisra6-video-gallery.onrender.com"><img src="https://i.postimg.cc/k4f7GzdQ/Screen-Shot-2023-05-23-at-19-12-06.png" alt="Screenshot" border="0"></a>
  
</h2>


## Key Features
* Docker Compatibility
  - The application is designed to work seamlessly with Docker, allowing for easy deployment and containerization of the app.
* Large Video Upload
  - The app is built to handle large video uploads, allowing users to upload and store videos of significant size without any limitations.
* Video File Conversion 
  - The application automatically creates reduced video files for streaming purposes, optimizing the video content for efficient delivery and playback.
* Google Drive Sync
  - The app can synchronize files from Google Drive with the local storage, ensuring that all relevant videos are available within the application.
* Search Functionality
  - The app provides a search feature, allowing users to quickly find specific videos based on titles, descriptions, or other relevant metadata.
* Video Properties
  - The application extracts and displays important video properties such as aspect ratio, resolution, and duration, giving users detailed information about each video.
* Error Handling
  - The app effectively handles errors and provides appropriate error messages or notifications to users, ensuring a smooth and uninterrupted user experience.
* Responsive Design
  - The user interface is designed to be responsive, adapting to different screen sizes and devices, including desktops, tablets, and mobile phones.
* User-friendly Interface
  - The app offers an intuitive and user-friendly interface, making it easy for users to navigate through the video gallery and access desired features.

## How To Use

To clone and run this application, you'll need [Git](https://git-scm.com), [PHP](https://www.php.net/) and [Docker](https://www.docker.com/) installed on your computer. 
From your command line:

```bash
# Clone this repository
$ git clone https://github.com/Omerisra6/login-system-php
    
# Set Google Client API Key in .env
GOOGLE_CLIENT_API_KEY=<YOUR_CLIENT_KEY>
    
# Build Image
docker build -t video-gallery-image .

# Serve App
docker run -p 80:80 video-gallery-image
```

## Credits

This software uses the following open source packages:

- [Laravel](https://laravel.com/)
- [Docker](https://www.docker.com/)
- [FFmpeg](https://ffmpeg.org/)

## License

MIT

---

> GitHub [@omerisra6](https://github.com/Omerisra6) &nbsp;&middot;&nbsp;
> Linkedin [@omerisraeli](https://www.linkedin.com/in/omer-israeli6/)

