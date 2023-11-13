@if ($errors->any())
    <div class="alert alert-danger" id='alert'>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('Success'))

<div class="col-md-2 mt-2">
    <div class="alert alert-success-soft show flex items-center mb-2"  id='alert' style='z-index: 1000; '>
        <ul>
            <li>{{ Session::get('Success')}}</li>
        </ul>
    </div>
</div>
@endif


@if(Session::has('Error'))
<div class="col-md-4 m-2">
    <div class="alert " id='alert' style='z-index: 1000;'>
        <ul>
            <li>{{ Session::get('Error')}}</li>
        </ul>
    </div>
</div>
@endif



@if(Session::has('SiteSuccess'))

<div class="col-md-2 mt-2">
    <div class="alert alert-success show flex items-center mb-2"  id='alert' style='z-index: 1000; '>
        <ul>
            <li>{{ Session::get('SiteSuccess')}}</li>
        </ul>
    </div>
</div>
@endif


@if(Session::has('SiteError'))
<div class="col-md-4 m-2">
    <div class="alert alert-danger " id='alert' style='z-index: 1000;'>
        <ul>
            <li>{{ Session::get('SiteError')}}</li>
        </ul>
    </div>
</div>
@endif


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">                                                                                  </script>
<script>

    $(document).ready(function(){
          $("#alert").delay(500).slideUp(300);
    });

    </script>
