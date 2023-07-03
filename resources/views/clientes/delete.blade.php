@extends('layouts.form')

<div class="modal fade" id="delete-{{$cliente->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title text-xl font-bold">Confirmação - #{{$cliente->id}}</h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
          </div>
          <div class="modal-body text-left">
            <p class="text-white">Você tem certeza que deseja continuar?</p>
          </div>

          <div class="modal-footer flex justify-end pt-2 border-t border-gray-300" >
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2" data-bs-dismiss="modal" >
                Cancelar
            </button>
            <a href="{{ Route('clientes.destroy',['cliente' => $cliente->id])}}">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" >
                Confirmar
            </button>
            </a>
          </div>
        </div>
    </div>
</div>

