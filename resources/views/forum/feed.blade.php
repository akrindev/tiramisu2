@extends('layouts.tabler')

@section('content')

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row">
              <div class="col-md-4">

                <!-- tags -->

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      Berdasarkan Tags
                    </h3>
                  </div>
                    <div class="p-0 m-0">

                      @include('inc.tags')

                    </div>

                </div>
                <!-- // tags -->

              </div>
              <div class="col-md-8">

                <a href="baru" class="align-right btn btn-primary btn-pill mb-3">Tulis baru</a>

                <div class="card">
                  <div class="p-0 m-0">
                    <table class="table card-table table-striped">

                      @foreach ($data as $pos)
                      <tr>
                        <td style="align:center;text-align:center;valign:middle" width=20% class="px-2 py-3"><img src="https://graph.facebook.com/{{ $pos->user->provider_id }}/picture?type=normal" class="avatar"></td>
                        <td width=75% class="px-0 py-2"><a href="/forum/{{ $pos->slug }}"><b>{{ str_limit($pos->judul,65) }} </b></a> <br>
                        <small class="text-muted">
   @php $nama = explode(' ',$pos->user->name); @endphp

                        {{ $nama[0] }}  on {{ waktu($pos->created_at) }}
                          </small></td>
                        <td class="text-right">
                          <b>7</b><br>
                          <small class="text-muted">replies</small></td>
                      </tr>
                    @endforeach


                    </table>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

@endsection