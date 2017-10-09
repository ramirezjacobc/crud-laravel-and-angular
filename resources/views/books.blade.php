@extends('layouts.app')

@section ('css')
  <link rel="stylesheet" href="https://unpkg.com/angular-toastr/dist/angular-toastr.css" />
  <link rel="stylesheet"; href="https://unpkg.com/ng-table@2.0.2/bundles/ng-table.min.css">
@endsection

@section('content')
    <div ng-app="app">
        <ng-view></ng-view>
    </div>
@endsection

@section('footer_js')
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular-route.js"></script>
    <script src="https://unpkg.com/angular-toastr/dist/angular-toastr.tpls.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular-animate.js"></script>
    <script src="https://unpkg.com/ng-table@2.0.2/bundles/ng-table.min.js"></script>

    <script src="/app/app.js"></script>
    <!--controllers-->
    <script src="/app/controllers/BookController.js"></script>

    <!--Services-->
    <script src="/app/services/BookService.js"></script>

    <!--Filters-->
    <script src="/app/filters/filters.js"></script>
@endsection
