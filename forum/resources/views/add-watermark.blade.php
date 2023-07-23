<x-dash>
    <div class="container">
        <h1>Add Watermark On Image</h2>

        <form action="{{route('image.watermark')}}" enctype="multipart/form-data" method="POST">
            @csrf
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>

            <div class="col-md-12 text-center">  
                {{-- {{ Session::all() }} --}}
                {{-- @dd(Session::all()) --}}
                <img src="{{ asset('uploads/' . Session::get('fileName')) }}" width="100%">
                {{-- <img src="../public/uploads/{{ Session::get('fileName') }}" width="100%"/> --}}
            </div>
            @endif

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="mb-3">
                <input type="file" name="file" class="form-control"  id="formFile">
            </div>

            <div class="d-grid mt-4">
                <button type="submit" name="submit" class="btn btn-primary">
                    Upload File
                </button>
            </div>
        </form>
    </div>
</x-dash>