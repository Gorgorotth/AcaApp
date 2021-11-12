@if (session()->has('success'))

    <div id="toast-container" class="toast-top-right close-session-message-output">
        <div class="toast toast-success" aria-live="polite" style="display: block;">
            <button class="btn toast-close-button session-close-button">x</button>
            <div class="toast-title">Success</div>
            <div class="toast-message">{{session()->get('success')}}</div>
        </div>
    </div>

{{--    <div class="bg-success mx-2 rounded-3 position-fixed">--}}
{{--        <p class="text-white p-1 my-2">{{session()->get('success')}}</p>--}}
{{--    </div>--}}


@elseif(session()->has('error'))

    <div id="toast-container" class="toast-top-right close-session-message-output">
        <div class="toast toast-error" aria-live="polite" style="display: block;">
            <button class="btn toast-close-button session-close-button">X</button>
            <div class="toast-title">Error</div>
            <div class="toast-message">{{session()->get('error')}}</div>
        </div>
    </div>

{{--    <div class="bg-danger mx-2 rounded-3 position-fixed">--}}
{{--        <p class="text-white p-1 my-2">{{session()->get('error')}}</p>--}}
{{--    </div>--}}

@elseif($errors->any())
    @foreach($errors->all() as $error)

        <div id="toast-container" class="toast-top-right close-session-message-output">
            <div class="toast toast-error" aria-live="polite" style="display: block;">
                <button class="btn toast-close-button session-close-button">X</button>
                <div class="toast-title">Validation Error</div>
                <div class="toast-message">{{$error}}</div>
            </div>
        </div>

{{--        <div class="bg-danger mx-2 rounded-3 ">--}}
{{--            <p class="text-white p-1 my-2">{{$error}}</p>--}}
{{--        </div>--}}
    @endforeach
@endif
{{--<script>--}}
{{--    window.toastMsgs = {--}}
{{--        success: '{!! json_encode(session()->get('success')) !!}',--}}
{{--    }--}}
{{--</script>--}}