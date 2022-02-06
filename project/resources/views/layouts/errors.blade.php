@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">
        <p>Investment was successful! </p>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        <p>Something went wrong</p>
    </div>
@endif
@if(session('error_money'))
    <div class="alert alert-danger">
        <p> Expected amount is exceed,please, invest equal or less than {{ session('error_money') }} $</p>
    </div>
@endif
@if(session('error_date'))
    <div class="alert alert-danger">
        <p>Project is closed</p>
    </div>
@endif
@if(session('error_start'))
    <div class="alert alert-danger">
        <p>Project has not started yet</p>
    </div>
@endif
