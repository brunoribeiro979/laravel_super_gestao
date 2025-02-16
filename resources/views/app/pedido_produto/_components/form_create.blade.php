<form action="{{ route('pedido-produto.store', ['pedido' => $pedido]) }}" method="post">
    @csrf

    <select name="produto_id" id="">
        <option selected>Selecione um Produto</option>

        @foreach ($produtos as $produto)
            <option value="{{ $produto->id }}" {{ old('produto_id') == $produto->id ? 'selected' : '' }}>
                {{ $produto->nome }}</option>
        @endforeach
    </select>
    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}

    <input type="number" name="quantidade" value="{{ old('quantidade') ?? '' }}" placeholder="Quantidade"
        class="borda-preta">
    {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}


    @if (isset($pedido->id))
        <button type="submit" class="borda-preta">Confirmar edição</button>
    @else
        <button type="submit" class="borda-preta">Cadastrar</button>
    @endif
</form>
