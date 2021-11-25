@if (session()->has('success'))

    <input type="hidden" value="{{session()->get('success')}}" id="session-success">

@elseif(session()->has('error'))

    <input type="hidden" value="{{session()->get('error')}}" id="session-custom-error">

@elseif($errors && $errors->any())
    @foreach($errors->all() as $error)

        <input type="hidden" value="{{$error}}" class="session-catch-exception">

    @endforeach
@endif