@extends('layouts.form')

<div class="modal fade" id="create" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Cadastro de fornecedor</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form class="g-3 needs-validation" method="POST" action="{{ route('movs_estoque.store') }}" novalidate>
                    @csrf
                    <div class="form-group row">
                      <label for="id_produto" class="col-3 col-form-label">Produto</label>
                      <div class="col-9">
                        <select id="id_produto" name="id_produto" class="form-control @error('id_produto') is-invalid @enderror" required>
                          @forelse($Produtos as $produto)
                            <option value="{{ $produto->id }}">
                              {{ $produto->id.' - '.$produto->nome }}
                            </option>
                          @empty
                            <option value="" selected>Nenhum produto cadastrado</option>
                          @endforelse
                        </select>
                        
                        @error('id_produto')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="id_fornecedor" class="col-3 col-form-label">Fornecedor</label>
                      <div class="col-9">
                        <select id="id_fornecedor" name="id_fornecedor" class="form-control @error('id_fornecedor') is-invalid @enderror" required>
                          @forelse($Fornecedores as $fornecedor)
                            <option value="{{ $fornecedor->id }}">{{ $fornecedor->id.' - '.$fornecedor->nome }}</option>
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
                      <label for="quantidade" class="col-3 col-form-label">Quantidade</label>
                      <div class="col-9">
                        <input type="number" id="quantidade" name="quantidade" value="1" class="form-control @error('quantidade') is-invalid @enderror" required>
                        @error('quantidade')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="data" class="col-3 col-form-label">Data</label>
                      <div class="col-9">
                        <input type="date" id="data" name="data" class="form-control @error('data') is-invalid @enderror">
                        @error('data')
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

