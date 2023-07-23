<!DOCTYPE html>
<html>

<head>
    <title>Upload files</title>
    <meta name="_token" content="{{csrf_token()}}" />
    <link href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>
    <style>
        .dropzone {

            width: 90%;
            min-height: 220px;
            border: 1px dashed #ddd;
            border-radius: 5px;
            background: #f5f7f5;
            margin: 0 auto;

        }

        .dropzone:hover {
            border: 1px dashed #53d335;
            background: #efffdd;
        }

        .dropzone_bx {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 23px;
        }

        .dropzone_bx button {
            border-style: none;
            width: 70%;
            display: block;
            padding: 10px 25px;
            background: #1dbb63;
            color: white;
            border-radius: 3px;
            font-size: 14px;
        }

        .action-buttons {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            font-size: 23px;
            margin-top: 10px;
        }

        .action-buttons button {
            border: none;
            border-style: none;
            display: block;
            padding: 10px 25px;
            background: #62766b;
            color: white;
            border-radius: 3px;
            font-size: 14px;
            margin: 0 5px;
        }

        .action-buttons button:hover {
            background: #5e7066;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('/') }}">LOGO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <img src="{{ asset(Auth::user()->avatar) }}" alt="" class="avatar" style="width: 40px">
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" id="log-form">
                            @csrf
                            <button class="btn btn-primary" id="logout" type="submit">Logout</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-secondary">Sign Up</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row pics">
            @foreach ($files as $file)
            <div class="col-md-3">
                <img src="{{ asset($file->address) }}" alt="" style="width: 300px; padding:10px" >
                <br>
            </div>
            @endforeach
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <h1>Upload</h1>

                <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data" id="dropzone"
                    class="dropzone">
                    @csrf
                    <div>
                        <h3>Upload Multiple Image By Click On Box</h3>
                    </div>
                </form>
                <div class="action-buttons">
                    <button type="button" id="uploadfiles">Upload files</button>
                    <button type="button" id="clear">Clear</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone(".dropzone", {
            headers: {
               'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            autoProcessQueue: false,
            uploadMultiple:false,
            parallelUploads: 10, // Number of files process at a time (default 2)
            maxFilesize: 2, //maximum file size 2MB
            maxFiles: 4,
            addRemoveLinks: "true",
            acceptedFiles: ".jpeg,.jpg,.png",
            dictDefaultMessage : '<div class="dropzone_bx"><button type="button">Browse a file</button><span>Or</span><b>Drag & Drop</b></div>',
            dictResponseError: 'Error uploading file!',
            thumbnailWidth: "150",
            thumbnailHeight: "150",
            createImageThumbnails: true,
            dictRemoveFile: "Remove",


            init: function () {
                var dropzone = this;
                $("#clear").click(function(){
                    dropzone.removeAllFiles(true);
                });
                this.on("success", function(file, response) {

                    $.ajax({
                        url: "{{ route('dropzone.refresh') }}",
                        type: "POST",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(data) {
                            $(".row").empty();
                            $(".navbar").empty();
                            $(".pics").empty().html(data);
                        }
                    });
                });
            },
        });


        $('#uploadfiles').click(function(){
            myDropzone.processQueue();
        });

    </script>

</body>

</html>