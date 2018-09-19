@extends('layouts.tabler')

@section('title', 'Toram NPC list')
@section('description', 'Toram database npc, list npc, quest, reward, npc picture and more')
@section('image', to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h3 class="page-title">Toram NPC</h3>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
          @foreach ($npcs as $npc)
            <div style="display:block;clear:both">
              <img src="{{ $npc->picture }}" style="width:100px;height:100px;float:left" class="mr-3">
           <i class="fe fe-wind"></i> <a href="/npc/npc-{{ $npc->id }}">{{ $npc->name }}</a><br>
              <small class="text-muted">( {{ $npc->map->name }} ) <br>
              terdapat: {{ $npc->quest->count() }} quest
              </small>
           </div>
            <div class="mb-2" style="clear:both"></div>
          @endforeach
          </div>
        </div>

        {{ $npcs->links() }}

      </div>

    </div>
  </div>
</div>
@endsection