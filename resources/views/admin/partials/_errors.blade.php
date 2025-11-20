@if ($errors->any())
    <div class="validation-errors" role="alert">
        <h5>{{  __('alerts.validation_errors', ['count' =>  count($errors)]) }}</h5>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
