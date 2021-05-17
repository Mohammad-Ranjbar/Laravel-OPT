<!DOCTYPE html>
<html>
<head>
    <title>Poster</title>
    <style>
        form>*{display:block}
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script>
        $(function(){
            $(".video-preview").change(function () {
                $(this).next().attr("src", URL.createObjectURL(this.files[0]));
            });
            $("form").submit(function(e){
                e.preventDefault();
                const form=this,
                    vp=this.querySelector(".video-preview"),
                    canvas=this.querySelector("canvas"),
                    video=this.querySelector("video"),
                    fd = new FormData(this);
                canvas.getContext('2d').drawImage(video,
                    0, 0,
                    video.videoWidth, video.videoHeight,
                    0, 0,
                    canvas.width,canvas.height
                );
                canvas.toBlob(function(blob){
                    fd.append("poster",blob,vp.files[0].name.replace(/\.[^\.]*$/,"-poster.jpg"));
                    // a little debugging
                    for(var pair of fd.entries()) {
                        console.log(pair[0], pair[1]);
                    };
                    // do ajax or fetch here!
                    fetch("post-data-ajax", {
                        method: 'post',
                        body: fd,
                    }).then(console.log,console.error);
                }, 'image/jpeg', .4);
            })
        })
    </script>
</head>
<body>
<form method="post" action="{{route('post-data')}}" enctype="multipart/form-data">
    @csrf
    <input class=video-preview type=file name=video >
    <video controls></video>
    <button>Send</button>
    <canvas width=256 height=144></canvas>
    <button type="submit">submit</button>
</form>
</body>
</html>
