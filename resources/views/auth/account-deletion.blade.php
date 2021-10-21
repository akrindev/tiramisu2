@extends('layouts.app')

@section('content')

<div class="my-5 my-md-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">
        Confirm deletion account
      </h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Delete your account</h3>
                </div>
                <div class="card-body">
                    <p>{{ $user->name }}</p>
                    <br>
                    Do you really want to delete your account?
                    <br>
                    <strong class="text-danger">Your account will be deleted permanently from our database and cant be recover</strong>
                </div>
                <div class="card-footer">
                    <form action="{{ route('user.delete') }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Yes, delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
