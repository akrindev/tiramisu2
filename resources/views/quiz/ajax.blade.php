<small class="text-muted float-right mb-3"> <span id="yang-ke" value="{{$id}}">{{ $id }}</span> / 10 </small>
  {{ toHtml(e($data['question'])) }}
<small class="text-muted mt-3">By {{ $data['by']}}</small>
<hr class="my-2">

 <div class="form-group mb-3">

   <div class="custom-controls-stacked">
         <label class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="jawaban-{{ $id }}" value="a" {{ session('jawaban-'.$id) == 'a' ? 'checked': '' }}>
            <div class="custom-control-label">{{ toHtml(e($data['jawaban_a'])) }} </div>
         </label>
   </div>


   <div class="custom-controls-stacked">
         <label class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="jawaban-{{ $id }}" value="b" {{ session('jawaban-'.$id) == 'b' ? 'checked': '' }}>
            <div class="custom-control-label">{{ toHtml(e($data['jawaban_b'])) }}</div>
         </label>
   </div>


   <div class="custom-controls-stacked">
         <label class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="jawaban-{{ $id }}" value="c" {{ session('jawaban-'.$id) == 'c' ? 'checked': '' }}>
            <div class="custom-control-label">{{ toHtml(e($data['jawaban_c'])) }}</div>
         </label>
   </div>


   <div class="custom-controls-stacked">
         <label class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="jawaban-{{ $id }}" value="d" {{ session('jawaban-'.$id) == 'd' ? 'checked': '' }}>
            <div class="custom-control-label">{{ toHtml(e($data['jawaban_d'])) }} </div>
         </label>
   </div>

</div>

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">


<div class="mt-4">
  @if ( $id != 1)
  <span onClick="gantiSoal({{$id-1}})" class="btn btn-secondary mr-2">kembali</span>
  @endif
  <button class="btn btn-outline-primary" id="btn-simpan" type="submit">Simpan</button>

  @if ( $id != 10)
  <span onClick="gantiSoal({{$id+1}})" class="btn btn-secondary float-right">Selanjutnya</span>
  @else
  <span onClick="koreksi()" class="btn btn-outline-success float-right">Koreksi</span>
  @endif
</div>