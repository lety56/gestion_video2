@extends('layouts.admin')

@section('content')
<style>
    .form-wrapper {
        max-width: 700px;
        margin: 30px auto;
        background: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
    }

    .form-wrapper h1 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 1.8em;
        color: #333;
    }

    table.form-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 15px;
    }

    table.form-table td {
        vertical-align: top;
    }

    table.form-table label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    table.form-table input,
    table.form-table textarea {
        width: 100%;
        padding: 6px 10px;
        font-size: 0.95em;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .invalid-feedback {
        color: red;
        font-size: 0.8em;
    }

    .submit-btn {
        display: block;
        width: 100%;
        margin-top: 20px;
        padding: 12px;
        font-size: 1em;
        font-weight: bold;
        color: white;
        background-color: #007bff;
        border: none;
        border-radius: 6px;
        transition: background 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }
</style>

<div class="form-wrapper">
    <h1>Modifier un Type d'Opération</h1>

   
    <form action="{{ route('type-operations.update', $typeOperation->id_pathologie) }}" method="POST">
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
