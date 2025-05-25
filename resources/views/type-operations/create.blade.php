<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GESTION DES VIDEOS</title>s
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: EstateAgency - v4.9.0
  * Template URL: https://bootstrapmade.com/real-estate-agency-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.html">GESTION<span class="color-b">VIDEOS</span></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('videos.create') }}">Videos</a>
        </li>
        
        

          <li class="nav-item">
            <a class="nav-link active" href="{{ route('categories.create') }}">Categories</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="{{ route('type-operations.create') }}">Operations</a>

          </li>

          <li class="nav-item">
            <a class="nav-link active" href="{{ route('pathologies.create') }}">Pathologies</a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ADMIN</a>
            <div class="dropdown-menu">
              <a class="dropdown-item " href="property-single.html">Property Single</a>
              <a class="dropdown-item " href="blog-single.html">Blog Single</a>
              <a class="dropdown-item " href="agents-grid.html">Agents Grid</a>
              <a class="dropdown-item " href="agent-single.html">Agent Single</a>
            </div>
          </li>
        
        </ul>
      </div>

      <button type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
        <i class="bi bi-search"></i>
      </button>

    </div>
  </nav><!-- End Header/Navbar -->






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
    <h1>Ajouter un Type d'Opération</h1>

    <form action="{{ route('type-operations.store') }}" method="POST">
        @csrf
        <table class="form-table">
            <tr>
                <td style="width: 35%;">
                    <label for="nom_type-operation">Nom du type d'opération</label>
                </td>
                <td>
                    <input 
                        type="text" 
                        name="nom_type_operation" 
                        id="nom_type_operation" 
                        value="{{ old('nom-type-operation') }}" 
                        class="@error('nom_type-operation') is-invalid @enderror"
                        required
                    >
                    @error('nom_type-operation')
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
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <button type="submit" class="submit-btn">
            Ajouter le type d'opération
        </button>
    </form>
</div>
@endsection
