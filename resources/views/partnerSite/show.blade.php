<div class="row">
  <div class="col-md-6 mb-5">
    <strong class='d-block'>10 Top Contributors <span class="ml-2 text-danger">&hearts;</span> </strong>
    <style>
    .collection-top-contri > .p {
        column-count: 2; -moz-column-count: 2; -webkit-column-count: 2;
        column-gap: 2em; -moz-column-gap: 2em; -webkit-column-gap: 2em;
    }

    .collection-top-contri .s {
        display: block;
    }

    </style>
    <div class="my-1 collection-top-contri">
      <div class="p">
        @foreach ((new App\Contribution)->with('user')->orderByDesc('point')->take(10)->get() as $contributor)
         <div class="s">{{ $loop->index+1 }}. {{ $contributor->user->name }} (<span class="text-primary">{{ $contributor->point }}</span>) </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-5">
    <strong>Bagaimana cara berkontribusi?</strong>
    <div class="d-block">
      - kamu dapat menambahkan item dan monster yang belum ada di situs ini. <br>
      - kamu juga dapat mengeditnya jika deskripsi atau namanya kurang tepat. <br>
      - kamu tidak perlu login untuk bisa berkontribusi, namun kami kami sarankan untuk login karena jika kamu berada dalam 10 top kontributor maka kamu bisa akses ke situs ini tanpa iklan.
    </div>

    <div class="d-block my-1 mt-5">
      Yuk <a href="/temp/drop/create" class="text-primary">tambah data item (drop)</a> atau <a href="/temp/monster/create" class="text-primary">tambah data monster</a>
    </div>
  </div>

  <hr class="my-1">

  <div class="col-md-6 mb-5">
		<div class="mb-4 text-center d-flex justify-content-center">
			<a href="/" class="mr-5 d-flex align-items-center"><i class="flag flag-id mr-2" style="width:1rem;height:0.8rem"></i>Indonesia</a> <a href="/en" class="d-flex align-items-center"><i class="flag flag-us mr-2" style="width:1rem;height:0.8rem"></i>English</a>
		</div>
        <span class="text-muted">
             <b>toram-id.info</b> is not affiliated with or endorsed by <b>Asobimo</b>. <b>toram-id.info</b> is a Database and Tools for the Toram Online game for mobile game app on iOS and Android.
        </span>
    </div>
  <div class="col-md-6">
  <h6>Sponsor Fansite</h6>

    <ul class="list-unstyled d-flex">
      <li><a href="https://www.youtube.com/channel/UCWjnDhpItCasRJghdyXbpjQ" target="_blank">
        <img src="/img/ball-triangle.svg" data-src="/partner/raymiku.png" class="lazyload animated infinite bounce" width=150 height="80">
        </a>
      </li>
      <li><a href="https://facebook.com/U28Blog" target="_blank">
        <img src="/img/ball-triangle.svg" data-src="/partner/r28.png" class="lazyload animated infinite tada" width=80 height="80">
        </a>
      </li>
      <li><a href="https://facebook.com/groups/319940072042046" target="_blank">
        <img src="/img/ball-triangle.svg" data-src="/partner/kaesa.png" class="lazyload animated infinite swing" width=80 height="80">
        </a>
      </li>
    </ul>
  </div>

</div>
