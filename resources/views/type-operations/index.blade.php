<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GESTION DES VIDEOS</title>
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
    .container { max-width: 900px; margin: auto; padding: 20px; }
    .table { border-collapse: collapse; width: 100%; margin-top: 20px; }
    th, td { border: 1px solid #dee2e6; padding: 10px; }
    th { background-color: #007bff; color: white; }
    .btn { padding: 5px 10px; border: none; border-radius: 4px; text-decoration: none; }
    .btn-edit { background-color: #ffc107; color: black; }
    .btn-delete { background-color: #dc3545; color: white; }
    .btn-add { background-color: #28a745; color: white; margin-bottom: 10px; }
</style>

<div class="container">
    <h2>Liste des Types d'Opérations</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('type-operations.create') }}" class="btn btn-add">Ajouter un Type</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
            <tr>
                <td>{{ $type->nom_type_operation }}</td>
                <td>{{ $type->description }}</td>
                <td>
                  <a href="{{ route('type-operations.edit', ['type_operation' => $type->id_type_operations]) }}" class="btn btn-edit">Modifier</a>


                  <form action="{{ route('type-operations.destroy', ['type_operation' => $type->id_type_operations]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Supprimer ce type ?')">Supprimer</button>
                </form>
                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
