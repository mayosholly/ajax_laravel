@extends('layouts.app')
@section('form')
    @include('form')
@endsection
@section('edit')
    @include('edit')
@endsection
@section('main')
<div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h3 class="text-light">Add Items</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addItemsModal"><i
                class="bi-plus-circle me-2"></i>Add New Item</button>
          </div>
          <div class="card-body" id="show_all_item">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

