@extends('layouts.form')

@extends('layouts.form')

<div class="modal fade" id="editar-{{$pedido->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edição de @if($pedido->status == 0) orçamento @else pedido @endif</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form class="g-3 needs-validation" method="POST" action="{{ route('pedidos.update',['pedido' => $pedido->id]) }}" novalidate>
                    @csrf
                    <div class="form-group row">
                      <label for="id" class="col-3 col-form-label">Id</label>
                      <div class="col-9">
                          <input type="number" name="id" id="id" class="form-control" placeholder="Digite..." value="{{$pedido->id}}" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="id_cliente" class="col-3 col-form-label">Cliente</label>
                      <div class="col-9">
                        <select id="id_cliente" name="id_cliente" class="form-control @error('id_cliente') is-invalid @enderror" required>
                          @forelse($Clientes as $cliente)
                            <option value="{{ $cliente->id }}" @if($cliente->id == $pedido->cliente->id) selected @endif>
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
                      <label for="data_entrega" class="col-3 col-form-label">Entrega</label>
                      <div class="col-9">
                        <input type="date" id="data_entrega" name="data_entrega" class="form-control @error('data_entrega') is-invalid @enderror" value="{{$pedido->data_entrega->format('Y-m-d')}}">
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