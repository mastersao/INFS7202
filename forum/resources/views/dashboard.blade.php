<x-dash>
    @if(Session::has('success'))
    <div id="success-alert" class="alert alert-success w-25  alert-dismissible fade show" role="alert">
        <p>{{ Session::get('success') }}</p>
    </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="list-group">
                <h1>Hello {{ $user->name }}!</h1>
                <h2>Welcome back!</h2>
                <h2>Your email is: {{ $user->email }}</h2>
                @if(! $user->email_verified_at == null)
                    <p>Your email has been verified at {{ $user->email_verified_at }}</p>
                @endif
                @if ($user->phone_number == null || $user->phone_number == "")
                <p>You haven't got a phone number :(</p>
                @else
                <h2>Your phone number is {{ $user->phone_number }}</h2>
                @endif
                <a class="btn-link" href="{{ route('update-details') }}">Update your personal imformation here</a>
                <br>
                <br>
                <a class="btn-link" href="{{ route('dropzone') }}">Upload pictures to the community</a>
                <br>
                <br>
                <a class="btn-link" href="{{ route('image.upload') }}">Add watermark to your image</a>
            </div>
            <br>
            <a class="btn-link" href="{{ route('stripe') }}">Many thanks if you would like to donate some money</a>
            <p style="margin-top: 40px">Here is your current location</p>

            <div class="map-container">
                <div id="map"></div>
            </div>

        </div>
    </div>
      
    <!-- prettier-ignore -->
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyCnsjzfeSEI9yWsZRj9Cij2wWdGlCJ9VF8", v: "weekly"});
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnsjzfeSEI9yWsZRj9Cij2wWdGlCJ9VF8&callback=initMap">
    </script>
    <script src="app.js"></script>

    <script>
        navigator.geolocation.getCurrentPosition(
        function (position) {
            initMap(position.coords.latitude, position.coords.longitude)
        },
        function errorCallback(error) {
            console.log(error)
        }
        );
        
        function initMap(lat, lng) {

            var myLatLng = {
                lat,
                lng
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
            });
        }
    </script>


    <script type="text/javascript">
        setTimeout(function () {
            $('#success-alert').alert('close');
        }, 3000);
    </script>

    <script type="text/javascript">
        var route = "{{ route('posts.autocomplete') }}";
        $('#search_query').typeahead({
        source: function (query, process) {
            return $.get(route, { 
            query: query }, function (data) {
                return process(data);
            });
            }
        });
    </script>

    </html>
</x-dash>