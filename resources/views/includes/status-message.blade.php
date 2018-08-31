@if(Session::has('message'))
    <div class="col-sm-12">
        <div class="alert alert-{{session('message')['status']}}">
            <strong>{{session('message')['message']}}</strong>
        </div>
    </div>
@endif