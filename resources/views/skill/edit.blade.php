@extends('layouts.tabler')

@section('title', 'Edit Skill')

@section('content')

<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Edit Skill</h3>
  </div>



  <div class="row">
    <div class="col-md-12">
    <div class="card">
      <div class="card-body p-3">

     {!! form_open_multipart('/skill/e/'.$skill->id.'/save') !!}
     @csrf
        <input type="hidden" name="id" value="{{ $skill->id }}">

      <div class="form-group">
        <label class="form-label">Icon</label>
        <img src="{{ $skill->picture }}" alt="" class="avatar avatar-md d-block mb-5">
        <input type="file" class="form-control" accept="image/*" name="icon">
      </div>

      <div class="form-group">
        <label class="form-label">Nama skill</label>
        <input type="text" class="form-control" name="name" value="{{ $skill->name }}" required>
      </div>

        <div class="form-group">
          <label class="form-label">Anggota skill</label>
          <select name="skill" id="select-type" class="form-control custom-select" required>
          @foreach((new App\Skill)->get() as $type)
            <option value="{{$type->id}}" data-data='{"image": "{{ $type->picture }}"}' {{ $type->id == $skill->skill_id ? 'selected':'' }}>{{ $type->name }}</option>
          @endforeach
          </select>
        </div>


     <div class="form-group">
       <label class="form-label">Skill level</label>
       <div class="selectgroup selectgroup-pills">
         @for($i = 1; 6 >= $i; $i++)
         <label class="selectgroup-item">
         <input name="level" type="radio" class="selectgroup-input" value="{{ $i }}" {{ $skill->level == $i ? 'checked' : '' }}>
           <span class="selectgroup-button">{{ $i }}</span>
         </label>
         @endfor
       </div>
     </div>

     <div class="form-group">
       <label class="form-label">Type</label>
       <div class="selectgroup selectgroup-pills">
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="active" {{ in_array('active', explode(',',$skill->type)) ? 'checked' : '' }}>
           <span class="selectgroup-button">active</span>
         </label>
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="pasif" {{ in_array('passive', explode(',',$skill->type)) || in_array('pasif', explode(',',$skill->type)) ? 'checked' : '' }}>
           <span class="selectgroup-button">passive</span></label>
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="skill fisik" {{ in_array('skill fisik', explode(',',$skill->type)) ? 'checked' : '' }}>
           <span class="selectgroup-button">skill fisik</span></label>
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="skill sihir" {{ in_array('skill sihir', explode(',',$skill->type)) ? 'checked' : '' }}>
           <span class="selectgroup-button">skill sihir</span></label>
         <label class="selectgroup-item">
         <input name="type[]" type="checkbox" class="selectgroup-input" value="EX Skill" {{ in_array('EX Skill', explode(',',$skill->type)) ? 'checked' : '' }}>
           <span class="selectgroup-button">EX Skill</span></label>
       </div>
     </div>

     <div class="form-group">
       <label class="form-label">MP Cost</label>
       <input type="number" class="form-control" value="{{ $skill->mp }}" name="mp">
     </div>

     <div class="form-group">
       <label class="form-label">Jarak <small class="text-muted">(m)</small> </label>
       <input type="number" class="form-control" name="range" value="{{ $skill->range }}">
     </div>


     <div class="form-group">
       <label class="form-label">Untuk senjata</label>
       <div class="selectgroup selectgroup-pills">

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="all" {{ in_array('all', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">semua senjata</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="bg" {{ in_array('bg', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">bowgun</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="busur" {{ in_array('busur', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">busur</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="dw" {{ in_array('dw', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">pedang ganda</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="katana" {{ in_array('katana', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">katana</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="knuckle" {{ in_array('knuckle', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">tinju</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="md" {{ in_array('md', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">alat sihir</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="mdsub" {{ in_array('mdsub', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">alat sihir sokongan</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="ohs" {{ in_array('ohs', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">pedang</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="panah" {{ in_array('panah', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">panah</span>
         </label>


         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="pisau" {{ in_array('pisau', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">pisau</span>
         </label>


         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="shield" {{ in_array('shield', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">tameng</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="ths" {{ in_array('ths', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">pedang raya</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="tongkat" {{ in_array('tongkat', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">tongkat</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="tombak" {{ in_array('tombak', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">tombak</span>
         </label>

         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="heavy" {{ in_array('heavy', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">armor berat</span>
         </label>
         <label class="selectgroup-item">
         <input name="for[]" type="checkbox" class="selectgroup-input" value="light" {{ in_array('light', explode(',', $skill->for)) ? 'checked' : '' }}>
           <span class="selectgroup-button">armor ringan</span>
         </label>

       </div>
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
          <span class="btn btn-outline-danger btn-pill mr-5" id="delete">Hapus skill</span>
        <button type="submit" class="btn btn-outline-primary btn-pill">Simpan perubahan </button>
        </div>

     {!! form_close() !!}

     {!! form_open('/admin/skill/child/delete', ['id' => 'hps']) !!}
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="{{ $skill->id }}">
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
let del = document.getElementById('delete');

  del.addEventListener('click', (e) => {
  	let ask = confirm('Yakin mau hapus skill ini? data akan di hapus secara permanen!!');

    if(ask) {
      document.getElementById('hps').submit();
    }

    return false;
  });

</script>

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