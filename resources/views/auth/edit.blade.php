@extends('layouts.base')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h3>Alterar senha</h3>
            <hr class="mt-3">
        </div>

        <div class="row text-center justify-center">
            <form class="g-3 needs-validation" method="POST" action="" novalidate>
                @csrf

                <div class="form-group row">
                    <label for="senhaAtual" class="col-3 col-form-label">Senha Atual</label>
                    <div class="col-3">
                      <input id="senhaAtual" name="senhaAtual" type="password" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="novaSenha" class="col-3 col-form-label">Nova senha</label>
                    <div class="col-3">
                      <input id="novaSenha" name="novaSenha" type="password" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-2"> </div>
                    <div class="col-3">
                      <button name="submit" type="submit" class="btn btn-success">Salvar</button>
                    </div>
                  </div>
            </form>
        </div>
        <hr class="mt-3 mb-3">
    </div>
</div>
@endsection

