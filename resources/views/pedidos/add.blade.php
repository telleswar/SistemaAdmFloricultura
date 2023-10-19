@extends('layouts.form')

@extends('layouts.form')

<div class="modal fade" id="add-{{$pedido->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Adicionar item ao @if($pedido->status == 0) orçamento @else pedido @endif</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form class="g-3 needs-validation" method="POST" action="{{ route('pedidos.add',['pedido' => $pedido->id]) }}" novalidate>
                    @csrf
                    <div class="form-group row">
                      <label for="id" class="col-3 col-form-label">Id</label>
                      <div class="col-9">
                          <input type="number" name="id" id="id" class="form-control" placeholder="Digite..." value="{{$pedido->id}}" disabled>
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
                        <input type="number" id="quantidade" name="quantidade" class="form-control @error('quantidade') is-invalid @enderror"  required>
                        @error('quantidade')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="offset-3 col-8">
                        <button id="submit" name="submit" type="submit" class="btn btn-success">Adicionar</button>
                      </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"> 

            </div>
        </div>
    </div>
</div>