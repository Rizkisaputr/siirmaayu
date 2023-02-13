@extends('admindek::auth.app')
@section('content')
<div class="row">
    <div class="col-4 offset-4 mt-5">
        <form method="POST" action="{{ route('login') }}">
            <div class="text-center mt-5">
                <h1>{{ config('app.name') }}</h1>
            </div>
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

            <div class="form-group row">
                <div class="input-field col ">
                    <i class="material-icons prefix">lock</i>
                    <input id="icon_prefix" type="password" class="validate " name="password" required
                        autocomplete="current-password" autofocus>
                    <label for="icon_prefix">{{ __('Password') }}</label>
                    @error('password')
                    <span class="helper-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row my-3">
                <div class="col-md-6">
                    <label>
                        <input type="checkbox" class="filled-in " {{ old('remember') ? 'checked' : '' }} />
                        <span>Lembre de mim</span>
                    </label>
                </div>
                <div class="col-md-6 text-right">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="text-decoration:none">
                        Esqueceu sua senha?
                    </a>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col">
                    <button type="submit" class="btn blue lighten-1 btn-block">{{ __('Login') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
