@extends('layouts.tabler')

@php
use Illuminate\Support\Facades\DB;

$tags = DB::table('tags')->get();

@endphp

@section('content')

<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col-12">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">Tulis baru</h3>
      </div>

      <div class="card-body">
      {!! form_open() !!}

        @csrf

      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control
        {{  $errors->has('judul') ? 'is-invalid': '' }}" required>
        @if($errors->has('judul'))
        <span class="invalid-feedback">
  			{{$errors->first('judul')}}
        </span>
        @endif
      </div>

      <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control {{  $errors->has('deskripsi') ? 'is-invalid': '' }}" name="deskripsi" rows=11></textarea>

        @if($errors->has('deskripsi'))
        <span class="invalid-feedback">
  			{{$errors->first('deskripsi')}}
        </span>
        @endif
        <div class="help-block text-muted">
          <small>Markdown supported!</small>
        </div>
      </div>


      <div class="form-group">
        <label class="form-label">Tags</label>

            <div class="selectgroup selectgroup-pills {{  $errors->has('tags') ? 'is-invalid': '' }}">
          @foreach ($tags as $tag)
                          <label class="selectgroup-item">
                            <input type="checkbox" name="tags[]" value="{{ $tag->name }}" class="selectgroup-input" {{ $tag->name == 'umum' ? 'checked':'' }}>
                            <span class="selectgroup-button">{{ $tag->name }}</span>
                          </label>
          @endforeach
        </div>

        @if($errors->has('tags'))
        <span class="invalid-feedback">
  			{{$errors->first('tags')}}
        </span>
        @endif
        </div>

      <button type="submit" class="btn btn-primary">Publish</button>
      {!! form_close() !!}



    </div>
  </div>
</div>

  <div class="col-12">

<div class="card card-body">
<h1 style="text-align:center;">Markdown Guide</h1>
<h4>Emphasis</h4>
<pre>**<strong>bold</strong>**
*<em>italics</em>*
~~<strike>strikethrough</strike>~~</pre>
<h4>Headers</h4>
<pre># Big header
## Medium header
### Small header
#### Tiny header</pre>
<h4>Lists</h4>
<pre>* Generic list item
* Generic list item
* Generic list item

1. Numbered list item
2. Numbered list item
3. Numbered list item</pre>
<h4>Links</h4>
<pre>[Text to display](http://www.example.com)</pre>
<h4>Quotes</h4>
<pre>> This is a quote.
> It can span multiple lines!</pre>
<h4>Images &nbsp; <small>Need to upload an image? <a href="http://imgur.com/" target="_blank">Imgur</a> has a great interface.</small></h4>
<pre>![](http://www.example.com/image.jpg)</pre>
<h4>Tables</h4>
<pre>| Column 1 | Column 2 | Column 3 |
| -------- | -------- | -------- |
| John     | Doe      | Male     |
| Mary     | Smith    | Female   |

<em>Or without aligning the columns...</em>

| Column 1 | Column 2 | Column 3 |
| -------- | -------- | -------- |
| John | Doe | Male |
| Mary | Smith | Female |
</pre>
<h4>Displaying code</h4>
<pre>`var example = "hello!";`

<em>Or spanning multiple lines...</em>

```
var example = "hello!";
alert(example);
```</pre>
<footer>Provided for use with <a href="http://sparksuite.github.io/simplemde-markdown-editor" target="_blank">SimpleMDE</a></footer>
</div>
  </div>
    </div>
  </div>
</div>



@endsection