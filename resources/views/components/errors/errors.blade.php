@if ($errors->any())
    <div class="d-flex justify-content-center">
        <div class="alert alert-danger auth-card text-center mb-4 ">
            <ul class="mb-0 list-unstyled">
                @foreach ($errors->all() as $error)
                    <li class="fw-bold">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
