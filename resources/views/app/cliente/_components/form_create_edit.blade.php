@if (isset($cliente->id))
    <form action="cliente{{ route('cliente.update', ['cliente' => $cliente->id]) }}" method="post">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('cliente.store') }}" method="post">
            @csrf
@endif



<input value="{{ $cliente->nome ?? old('nome') }}" type="text" name="nome" class="borda-preta" placeholder="Nome">
{{ $errors->has('nome') ? $errors->first('nome') : '' }}


@if (isset($cliente->id))
    <button type="submit" class="borda-preta">Confirmar edição</button>
@else
    <button type="submit" class="borda-preta">Cadastrar</button>
@endif
</form>
