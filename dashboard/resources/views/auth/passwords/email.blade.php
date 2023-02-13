@extends('admindek::auth.app')
@section('content')
<div class="row">
    <div class="col-4 offset-4 mt-5">
        <div class="text-center mt-5">
           <h5>Recuperar Senha</h5>
        </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group row">
                        <div class="input-field col">
                            <i class="material-icons prefix">mail</i>
                            <input id="icon_prefix" type="text" class="validate" name="email" value="{{ old('email') }}"
                                required autocomplete="email" autofocus>
                            <label for="icon_prefix">{{ __('E-Mail') }}</label>
                            @error('email')
                            <span class="helper-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                <div class="form-group row mb-0">
                    <div class="col">
                        <button type="submit" class="btn blue lighten-1 btn-block">
                           Enviar link para recuperar o acesso
                        </button>
                    </div>
                </div>
            </form>
    </div>
</div>
@endsection
