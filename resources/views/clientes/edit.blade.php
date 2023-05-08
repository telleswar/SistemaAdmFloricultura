@extends('layouts.form')

<div class="modal fade text-left" id="editar-{{$cliente->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edição de cliente</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form class="g-3 needs-validation" method="POST" action="{{ route('clientes.update',['cliente' => $cliente->id]) }}" novalidate>
                    @csrf
                    <div class="form-group row">
                        <label for="id" class="col-4 col-form-label">Id</label>
                        <div class="col-8">
                            <input type="number" name="id" id="id" class="form-control" placeholder="Digite..." value="{{$cliente->id}}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nome" class="col-4 col-form-label">Nome</label>
                        <div class="col-8">
                          <input id="nome" name="nome" type="text" class="form-control @error('nome') is-invalid @enderror" value="{{$cliente->nome}}" required>
                          @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="cpf" class="col-4 col-form-label">CPF</label>
                        <div class="col-8">
                          <input id="cpf" name="cpf" type="text" class="form-control cpf @error('cpf') is-invalid @enderror" value="{{$cliente->cpf}}" required maxlength="14">
                          @error('cpf')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="email" class="col-4 col-form-label" >E-mail</label>
                        <div class="col-8">
                          <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{$cliente->email}}" required>
                          @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="telefone" class="col-4 col-form-label" >Telefone</label>
                        <div class="col-8">
                          <input id="telefone" name="telefone" type="text" class="form-control @error('telefone') is-invalid @enderror" value="{{$cliente->telefone}}" required>
                          @error('telefone')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="endereco" class="col-4 col-form-label">Endereço</label>
                        <div class="col-8">
                          <input id="endereco" name="endereco" type="text" class="form-control @error('endereco') is-invalid @enderror" value="{{$cliente->endereco}}" required>
                          @error('endereco')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="offset-4 col-8">
                          <button name="submit" type="submit" class="btn btn-success">Salvar</button>
                        </div>
                      </div>

                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

