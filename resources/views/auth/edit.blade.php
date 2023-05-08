@extends('layouts.base')

@section('content')

<div id="alterar-senha" class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h3>Alterar senha</h3>
            <hr class="mt-3">
        </div>

        <div class="row text-center justify-center">
            <form class="g-3 needs-validation" method="POST" action="{{ route('auth.store') }}" novalidate>
                @csrf

                <div class="form-group row">
                  <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Nova senha</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm"
                        class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                    <div class="offset-3 col-3">
                      <button name="submit" type="submit" class="btn btn-success">Salvar</button>
                    </div>
                  </div>
            </form>
        </div>
        <hr class="mt-3 mb-3">
    </div>
</div>
@endsection

