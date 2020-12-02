<div class="card">
  <div class="card-body p-2" style="font-size:13px;font-weight:400">

    	<!-- Tab head -->
        <ul class="nav nav-tabs justify-content-center" id="statusTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link {{ App::isLocale('id') ? 'active' :  '' }}" id="indonesia-tab" data-toggle="tab" href="#indonesia" role="tab" aria-controls="indonesia" aria-selected="true">
              Indonesia
              @if(App::isLocale('id'))
              <span class="nav-unread"></span>
              @endif
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ App::isLocale('en') ? ' active' :  '' }}" id="english-tab" data-toggle="tab" href="#english" role="tab" aria-controls="english" aria-selected="false">English
              @if(App::isLocale('en'))
              <span class="nav-unread"></span>
              @endif
              </a>
            </li>
          </ul>
		<!-- Tab head end -->

		<!-- Tab content -->
		<div class="tab-content" id="statusTabContent">
            <div class="tab-pane fade {{ App::isLocale('id') ? 'show active' :  '' }}" id="indonesia" role="tabpanel" aria-labelledby="indonesia-tab">
              <div class="my-5">

                 @include('inc.menu-indo')

              </div>
            </div>
            <div class="tab-pane fade {{ App::isLocale('en') ? ' show active' :  '' }}" id="english" role="tabpanel" aria-labelledby="english-tab">

              <div class="my-5">

                  @include('inc.menu-english')

              </div>

            </div>
          </div>

      <hr class="my-1">


    <div class="my-1 row gutters-xs">
      <b class="d-block col-12 mb-2">Lainnya</b>
      <a href="/prestasi" class="d-block mb-1 col-12"> <img src="/img/prestasi.png" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">Emblem / Prestasi</a>
      <a href="/cooking/berteman" class="d-block mb-1 col-12"> <img src="/img/cook-pt.png" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">Buff Food Member</a>

      <a href="/potensi/kalkulator" class="d-block mb-1 col-12"> <img src="/img/skill/smith/noviceanvil.png" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">Potensi Simulator</a>
      <a href="/avatar" class="d-block mb-1 col-12"> <img src="/img/ava_top.png" class="avatar avatar-sm mr-1" style="max-width:20px;max-height:19px">Avatar Showcase</a>

      <div class="d-block col-12 mb-5"></div>

      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/dye">Dye Bulanan (Monthly Dye)</a> </span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/gallery">Gallery</a> </span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/forum">Forum</a> </span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/peta">Peta (Map)</a> </span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/skill">Skill List</a></span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/refine">Refine Guide</a></span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/refine/simulasi">Refine Simulator</a></span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/cb">Papan Market Calculator</a></span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/leveling">Leveling List</a></span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/fill_stats">Fill stats formula</a></span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/fill_stats/calculator">Fill Stat Simulator</a></span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/exp">Exp Calculator</a></span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/mq_exp">Main Quest Exp Calculator (MQ)</a></span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/npc">NPC List</a></span>
      <span class="d-block mb-1 col-6"><i class="fe fe-chevrons-right mr-1"></i><a href="/quiz">QUIZ</a></span>
    </div>
  </div>


    <hr class="my-1">

    @includeUnless(app()->isLocal(), 'inc.ads_matched')
</div>