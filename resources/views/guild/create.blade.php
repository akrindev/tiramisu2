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
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name='name' placeholder="Nama guild" min="2" max="16" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Informasi Guild" data-provide="markdown" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Logo</label>
                                        <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*" required>
                                        @error('logo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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

@section('head')

<link href="/assets/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css">
<script src="/assets/js/bootstrap-markdown.js">
</script>
<script src="/assets/js/markdown.js">
</script>
<script src="/assets/js/to-markdown.js">
</script>
@endsection
