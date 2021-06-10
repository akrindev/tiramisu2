@extends('layouts.tabler')

@section('title', 'Tambah Guild')

@section('content')
    <div class="my-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">Tambah Guild</h1>
            </div>


            <div class="row">
                <div class="col-md-8">

                        <div class="card">
                            <div class="card-body p-3">

                                <form action="{{ route('guilds.store') }}" method="post" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-group">
                                        <label class="form-label">Nama Guild</label>
                                        <input type="text" class="form-control" name='name' placeholder="Nama guild" max="16" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="description" rows="5" class="form-control" placeholder="Informasi Guild" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Logo</label>
                                        <input type="file" name="logo" id="logo" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Guild Level</label>
                                        <select name="level" id="level" class="form-control">
                                            <option value="1" selected> 1 </option>
                                            @for ($i = 2; $i <= 49; $i++)
                                                <option value="{{ $i }}"> {{ $i }} </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection
