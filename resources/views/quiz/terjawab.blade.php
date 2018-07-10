<b> Jawaban di simpan: </b> {{ $terjawab }} / 10
<br>
@for ($i = 1; $i <= 10; $i++)

         <a onClick="gantiSoal({{ $i }})" style="padding:10px;display:inline-block;border:1px solid grey;margin:1px">
         Q: {{ $i }} (
    @switch(session('jawaban-'.$i))
        @case('a')
			a
			@break
		@case('b')
			b
			@break
		@case('c')
			c
			@break
         @case('d')
			d
			@break
		@default
			&nbsp;
			@break
	@endswitch
)
         </a>

@endfor