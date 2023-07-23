<x-arti>
  <form class="container" style="margin-top: 100px" method="POST" action="{{ route('thread.create') }}"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" placeholder="" name="title">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" id="description" rows="3" placeholder="" name="excerpt"></textarea>
    </div>
    <div class="form-group">
      <label for="body">Main content</label>
      <textarea class="form-control" id="thread-body" rows="10" placeholder="..." name="body"></textarea>
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select name="category_id" id="category_id">
        @php
        $categories = \App\Models\Category::all();
        @endphp
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach

      </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>

  <script type="text/javascript">
  Dropzone.autoDiscover = false;
  // Dropzone.options.demoform = false;	
  let token = $('meta[name="csrf-token"]').attr('content');
  $(function() {
  var myDropzone = new Dropzone("div#dropzoneDragArea", { 
    paramName: "file",
    url: "{{ url('/storeimgae') }}",
    previewsContainer: 'div.dropzone-previews',
    addRemoveLinks: true,
    autoProcessQueue: false,
    uploadMultiple: false,
    parallelUploads: 1,
    maxFiles: 1,
    params: {
          _token: token
      },
    // The setting up of the dropzone
    init: function() {
        var myDropzone = this;
        //form submission code goes here
        $("form[name='demoform']").submit(function(event) {
          //Make sure that the form isn't actully being sent.
          event.preventDefault();

          URL = $("#demoform").attr('action');
          formData = $('#demoform').serialize();
          $.ajax({
            type: 'POST',
            url: URL,
            data: formData,
            success: function(result){
              if(result.status == "success"){
                // fetch the useid 
                var userid = result.user_id;
              $("#userid").val(userid); // inseting userid into hidden input field
                //process the queue
                myDropzone.processQueue();
              }else{
                console.log("error");
              }
            }
          });
        });

        //Gets triggered when we submit the image.
        this.on('sending', function(file, xhr, formData){
        //fetch the user id from hidden input field and send that userid with our image
          let userid = document.getElementById('userid').value;
        formData.append('userid', userid);
      });
      
        this.on("success", function (file, response) {
              //reset the form
              $('#demoform')[0].reset();
              //reset dropzone
              $('.dropzone-previews').empty();
          });

          this.on("queuecomplete", function () {
      
          });
      
          // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
        // of the sending event because uploadMultiple is set to true.
        this.on("sendingmultiple", function() {
          // Gets triggered when the form is actually being sent.
          // Hide the success button or the complete form.
        });
      
        this.on("successmultiple", function(files, response) {
          // Gets triggered when the files have successfully been sent.
          // Redirect user or notify of success.
        });
      
        this.on("errormultiple", function(files, response) {
          // Gets triggered when there was an error sending the files.
          // Maybe show form again, and notify user of error
        });
    }
    });
  });

  </script>

</x-arti>

