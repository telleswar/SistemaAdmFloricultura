@extends('layouts.form')

<div class="modal fade" id="create" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Novo pedido</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form class="g-3 needs-validation" method="POST" action="{{ route('pedidos.store') }}" novalidate>
                    @csrf
                    <div class="form-group row">
                      <label for="id_cliente" class="col-3 col-form-label">Cliente</label>
                      <div class="col-9">
                        <select id="id_cliente" name="id_cliente" class="form-control @error('id_cliente') is-invalid @enderror" required>
                          @forelse($Clientes as $cliente)
                            <option value="{{ $cliente->id }}">
                              {{ $cliente->id.' - '.$cliente->nome }}
                            </option>
                          @empty
                            <option value="" selected>Nenhum cliente cadastrado</option>
                          @endforelse
                        </select>
                        
                        @error('id_cliente')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

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
                      <label for="quantidade" class="col-3 col-form-label">Quantidade</label>
                      <div class="col-9">
                        <input type="number" id="quantidade" name="quantidade" value="1" class="form-control @error('quantidade') is-invalid @enderror" required>
                        @error('quantidade')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="data_entrega" class="col-3 col-form-label">Entrega</label>
                      <div class="col-9">
                        <input type="date" id="data_entrega" name="data_entrega" class="form-control @error('data_entrega') is-invalid @enderror">
                        @error('data_entrega')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="offset-3 col-8">
                        <button id="submit" name="submit" type="submit" class="btn btn-success">Salvar</button>
                      </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"> 

            </div>
        </div>
    </div>
</div>

