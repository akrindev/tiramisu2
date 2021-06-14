@extends('layouts.tabler')

@section('title', 'Edit Guild')

@section('content')
    <div class="my-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">Edit Guild</h1>
            </div>


            <div class="row">
                <div class="col-md-8">

                        <div class="card">
                            <div class="card-body p-3">

                                <form action="{{ route('guilds.update', $guild->id) }}" method="post" enctype="multipart/form-data">

                                    @csrf
                                    @method('put')

                                    @can('manager', $guild)

                                    <div class="form-group">
                                        <label class="form-label">Nama Guild</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name='name' placeholder="Nama guild" max="16" value="{{ $guild->name }}" required>
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @endcan

                                    <div class="form-group">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Informasi Guild" data-provide="markdown" required>{{ $guild->description }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Logo</label>
                                        <div id="preview" class="my-3">
                                            <img src="{{ asset($guild->logo) }}" alt="{{ $guild->name }}">
                                        </div>
                                        <input type="file" name="logo" id="logo" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Guild Level</label>
                                        <select name="level" id="level" class="form-control">
                                            @for ($i = 1; $i <= 49; $i++)
                                                <option value="{{ $i }}" {{ $i == $guild->level ? 'selected' : '' }}> {{ $i }} </option>
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
