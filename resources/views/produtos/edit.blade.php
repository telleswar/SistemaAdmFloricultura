@extends('layouts.form')

<div class="modal fade text-left" id="editar-{{$produto->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edição de produto</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form class="g-3 needs-validation" method="POST" action="{{ route('produtos.update',['produto' => $produto->id]) }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="form-group row">
                      <label for="id" class="col-4 col-form-label">Id</label>
                      <div class="col-8">
                          <input type="number" name="id" id="id" class="form-control" placeholder="Digite..." value="{{$produto->id}}" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                        <label for="nome" class="col-4 col-form-label">Nome</label>
                        <div class="col-8">
                          <input id="nome" name="nome" type="text" class="form-control @error('nome') is-invalid @enderror" value="{{$produto->nome}}" required>
                        
                          @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="tipo" class="col-4 col-form-label" >Tipo</label>
                        <div class="col-8">
                          <input id="tipo" name="tipo" type="text" class="form-control @error('tipo') is-invalid @enderror" value="{{$produto->tipo}}" required>
                          @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="custo" class="col-4 col-form-label" >Custo</label>    
                        <div class="col-8">
                          <input class="form-control @error('custo') is-invalid @enderror" type="currency" name="custo" id="custo" value="{{$produto->custo}}">
                          @error('custo')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="preco_unitario" class="col-4 col-form-label" >Preço unitário</label>    
                        <div class="col-8">
                          <input class="form-control @error('preco_unitario') is-invalid @enderror" type="currency" name="preco_unitario" id="preco_unitario" value="{{$produto->preco_unitario}}">
                          @error('preco_unitario')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="descricao" class="col-4 col-form-label">Descrição</label>
                        <div class="col-8">
                          <textarea id="descricao" name="descricao" class="form-control">{{$produto->descricao}}</textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="imagem" class="col-4 col-form-label" >Imagem:</label>
                        <div class="col-8">
                          <input id="imagem" name="imagem" type="file" class="form-control from-control-file @error('imagem') is-invalid @enderror">
                          @error('imagem')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="offset-4 col-8">
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

