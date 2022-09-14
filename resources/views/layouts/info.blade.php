@if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            makeErrorToast('Erro', `<ul>
                    @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
                    @endforeach
            </ul>`, 5000);
        });
    </script>
@endif

@if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            makeSuccessToast('Sucesso!', "{{session('success')}}", 5000);
        });
    </script>
@endif
@if(session('warning'))
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            makeWarningToast('Atenção!', "{{session('warning')}}", 5000);
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            makeErrorToast('Erro', "{{session('error')}}", 5000);
        });
    </script>
@endif
