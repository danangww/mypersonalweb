@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Categories</h1>
        </div><!-- /.col -->
        {{-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol>
        </div><!-- /.col --> --}}
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          @include('_modules.alert')

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List Categories</h5>

              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's
                content.
              </p>

              <a href="{{ route('categories.create') }}" class="btn btn-primary mb-2">Add</a>

              <table class="table table-hover table-bordered datatables">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($categories as $index => $category)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $category->name }}</td>
                      <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <button class="btn btn-danger btn-sm" onclick="showDeleteConfirmation('delete-category-{{ $category->id }}')">Delete</a>

                        <form id="delete-category-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="post">
                          @csrf
                          @method('delete')
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="3" align="center">No Data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection