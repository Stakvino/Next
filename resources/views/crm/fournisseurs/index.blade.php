@extends('crm.layouts.master')

@section('title')
    | Fournisseur
@endsection

@section('content')

    @include('crm.fournisseurs.includes._filter')

    @include('crm.fournisseurs.includes._listing')

@endsection

@section('extra-js')
  <script>

  </script>
@endsection