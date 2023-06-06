@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Portfolios</h1>
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
              <h5 class="card-title">List Portfolio</h5>

              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's
                content.
              </p>

              <a href="{{ route('portfolios.create') }}" class="btn btn-primary mb-2">Add</a>

              <table class="table table-hover table-bordered datatables">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($data as $index => $item)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $item->category->name }}</td>
                      <td><img src="{{ asset($item->image_file_url) }}" alt="" width="200"></td>
                      <td>{{ $item->title }}</td>
                      <td>{{ $item->description }}</td>
                      <td>
                        <a href="{{ route('portfolios.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <button class="btn btn-danger btn-sm" onclick="showDeleteConfirmation('delete-portfolio-{{ $item->id }}')">Delete</a>

                        <form id="delete-portfolio-{{ $item->id }}" action="{{ route('portfolios.destroy', $item->id) }}" method="post">
                          @csrf
                          @method('delete')
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" align="center">No Data</td>
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