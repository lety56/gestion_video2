@extends('layouts.admin')

@section('content')
<style>
    /* ... ta CSS ... */
</style>

<div class="form-wrapper">
    <h1>Modifier un Type d'Opération</h1>

    <form action="{{ route('type-operations.update', $typeOperation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table class="form-table">
            <tr>
                <td style="width: 35%;">
                    <label for="nom_type_operation">Nom du type d'opération</label>
                </td>
                <td>
                    <input
                        type="text"
                        name="nom_type_operation"
                        id="nom_type_operation"
                        value="{{ old('nom_type_operation', $typeOperation->nom_type_operation) }}"
                        class="@error('nom_type_operation') is-invalid @enderror"
                        required
                    >
                    @error('nom_type_operation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    <label for="description">Description</label>
                </td>
                <td>
                    <textarea
                        name="description"
                        id="description"
                        rows="3"
                        class="@error('description') is-invalid @enderror"
                    >{{ old('description', $typeOperation->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <button type="submit" class="submit-btn">
            Modifier le type d'opération
        </button>
    </form>
</div>
@endsection
