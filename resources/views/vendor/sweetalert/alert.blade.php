@if (Session::has('alert.config') || Session::has('alert.action'))
    @if (config('sweetalert.animation.enable'))
        <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    @endif
    @if (config('sweetalert.theme') != 'default')
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-{{ config('sweetalert.theme') }}" rel="stylesheet">
    @endif
    @if (config('sweetalert.alwaysLoadJS') === false && config('sweetalert.neverLoadJS') === false)
        <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @endif
    <script>
        @if (Session::has('alert.action'))
            document.addEventListener('click', function(event) {
                if (event.target.matches('[data-confirm-action]')) {
                    event.preventDefault();
                    var method = event.target.getAttribute('data-confirm-action').toUpperCase();
                    console.log(method);
                    Swal.fire({!! Session::pull('alert.action') !!}).then(function(result) {
                        if (result.isConfirmed) {
                            var form = document.createElement('form');
                            form.action = event.target.href;
                            form.method = 'POST';
                            form.innerHTML = `
                                @csrf
                                @method('${method}')
                            `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                }
            });
        @endif
        @if (Session::has('alert.config'))
            Swal.fire({!! Session::pull('alert.config') !!});
        @endif
    </script>
@endif
