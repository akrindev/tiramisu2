@extends('layouts.tabler')

@section('title', 'Edit Skill')

@section('content')

<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Edit Skill</h3>
  </div>



  <div class="row">
    <div class="col-md-8">
    <div class="card">
      <div class="card-body p-3">

     {!! form_open('/skill/edit/save') !!}
     @csrf
        <input type="hidden" name="id" value="{{ $skill->id }}">

      <div class="form-group">
        <label class="form-label">Icon</label>
        <img src="{{ $skill->picture }}" alt="" class="avatar avatar-md d-block">
      </div>

      <div class="form-group">
        <label class="form-label">Nama skill</label>
        <input type="text" class="form-control" name="name" value="{{ $skill->name }}" required>
      </div>

        <div class="form-group">
          <label class="form-label">Anggota skill</label>
          <select name="skill" id="select-type" class="form-control custom-select" required>
          @foreach((new App\Skill)->get() as $type)
            <option value="{{$type->id}}" data-data='{"image": "{{ $type->picture }}"}'>{{ $type->name }}</option>
          @endforeach
          </select>
        </div>

     <div class="form-group">
       <label class="form-label">Type</label>
       <div class="selectgroup selectgroup-pills">
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="active" {{ in_array('active', explode(',',$skill->type)) ? 'checked' : '' }}>
           <span class="selectgroup-button">active</span>
         </label>
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="passive" {{ in_array('passive', explode(',',$skill->type)) ? 'checked' : '' }}>
           <span class="selectgroup-button">passive</span></label>
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="skill fisik" {{ in_array('skill fisik', explode(',',$skill->type)) ? 'checked' : '' }}>
           <span class="selectgroup-button">skill fisik</span></label>
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="skill sihir" {{ in_array('skill sihir', explode(',',$skill->type)) ? 'checked' : '' }}>
           <span class="selectgroup-button">skill sihir</span></label>
       </div>
     </div>

     <div class="form-group">
       <label class="form-label">MP Cost</label>
       <input type="number" class="form-control" value="{{ $skill->mp }}" name="mp">
     </div>

     <div class="form-group">
       <label class="form-label">Jarak</label>
       <input type="number" class="form-control" name="range" value="{{ $skill->range }}">
     </div>

     <div class="form-group">
       <label class="form-label">Combo awal</label>
       <div class="selectgroup selectgroup-pills">

         <label class="selectgroup-item">
         <input name="combo_awal" type="radio" class="selectgroup-input" value="1" {{ $skill->combo_awal == 1 ? 'checked' : '' }}>
           <span class="selectgroup-button">ya</span>
         </label>
         <label class="selectgroup-item">
         <input name="combo_awal" type="radio" class="selectgroup-input" value="0" {{ $skill->combo_awal == 0 ? 'checked' : '' }}>
           <span class="selectgroup-button">tidak</span>
         </label>

       </div>
     </div>

     <div class="form-group">
       <label class="form-label">Combo tengah</label>
       <div class="selectgroup selectgroup-pills">

         <label class="selectgroup-item">
         <input name="combo_tengah" type="radio" class="selectgroup-input" value="1" {{ $skill->combo_tengah == 1 ? 'checked' : '' }}>
           <span class="selectgroup-button">ya</span>
         </label>
         <label class="selectgroup-item">
         <input name="combo_tengah" type="radio" class="selectgroup-input" value="0" {{ $skill->combo_tengah == 0 ? 'checked' : '' }}>
           <span class="selectgroup-button">tidak</span>
         </label>

       </div>
     </div>

      <div class="form-group">
        <label class="form-label">Element</label>
<div class="selectgroup selectgroup-pills">
  @foreach ((new App\Element)->get() as $el)
  <label class="selectgroup-item">
    <input type="radio" name="element" class="selectgroup-input" value="{{$el->id}}" {{ $el->id == $skill->element_id ? 'checked':'' }}>
    <span class="selectgroup-button">{{ $el->name }}</span>
  </label>
  @endforeach
        </div>
        </div>

        <div class="form-group">
          <label class="form-label">Deskripsi</label>
          <textarea name="body" data-provide="markdown" rows="10" class="form-control">{{ $skill->description }}</textarea>
        </div>

        <div class="form-group">
        <button type="submit" class="btn btn-outline-primary btn-pill"> <i class="fe fe-edit"></i> simpan perubahan </button>
        </div>

     {!! form_close() !!}
      </div>
    </div>
    </div>
  </div>
  </div>
</div>

@endsection


@section('head')

<link href="/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css">
<script src="/assets/js/bootstrap-markdown.js">
</script>
<script src="/assets/js/markdown.js">
</script>
<script src="/assets/js/to-markdown.js">
</script>

<script src="/assets/js/vendors/selectize.min.js"></script>
@endsection

@section('footer')

<script>
$('#select-type').selectize({
    render: {
      option: function (data, escape) {
        return '<div>' +
          '<span class="image"><img src="' + data.image + '" alt=""></span>' +
          '<span class="title">' + escape(data.text) + '</span>' +
          '</div>';
      },
      item: function (data, escape) {
        return '<div>' +
          '<span class="image"><img src="' + data.image + '" alt=""></span>' +
          escape(data.text) +
          '</div>';
      }
    }
  });
</script>
@endsection