@extends('layouts.form')

<div class="modal fade" id="create_despesa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Nova despesa</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form class="g-3 needs-validation" method="POST" action="{{ route('movs_financeira.store_despesa') }}" novalidate>
                    @csrf
                    <div class="form-group row">
                      <label for="id_fornecedor" class="col-3 col-form-label">Fornecedor</label>
                      <div class="col-9">
                        <select id="id_fornecedor" name="id_fornecedor" class="form-control @error('id_fornecedor') is-invalid @enderror" required>
                          @forelse($Fornecedores as $fornecedor)
                            <option value="{{ $fornecedor->id }}">
                              {{ $fornecedor->id.' - '.$fornecedor->nome }}
                            </option>
                          @empty
                            <option value="" selected>Nenhum fornecedor cadastrado</option>
                          @endforelse
                        </select>
                        
                        @error('id_fornecedor')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                        <label for="valor" class="col-3 col-form-label" >Valor</label>    
                        <div class="col-9">
                          <input  type="currency" name="valor" id="valor" value="0.00" class="form-control @error('valor') is-invalid @enderror">
                          @error('valor')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                    <div class="form-group row">
                      <label for="data_limite" class="col-3 col-form-label">Vencimento</label>
                      <div class="col-9">
                        <input type="date" id="data_limite" name="data_limite" class="form-control @error('data_limite') is-invalid @enderror">
                        @error('data_limite')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="data_pagto" class="col-3 col-form-label">Pagamento</label>
                      <div class="col-9">
                        <input type="date" id="data_pagto" name="data_pagto" class="form-control @error('data_pagto') is-invalid @enderror">
                        @error('data_pagto')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="offset-3 col-9">
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

