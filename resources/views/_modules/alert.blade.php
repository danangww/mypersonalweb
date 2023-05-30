<div class="row">
    <div class="col-lg-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                There's some error(s):
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Session::get('flash_notification.level'))
            <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                {!! Session::get('flash_notification.message') !!}
            </div>
        @endif
    </div>
</div>
