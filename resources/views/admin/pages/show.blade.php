@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Titolo: {{$page->title}}</h2>
        <h3>Categoria: {{$page->category->name}}</h3>
        {{-- sta facendo una INNER JOIN entrando nella TAB USER --}}
        <small>Scritto da: {{$page->user->name}}</small>
        <small>{{$page->update_at}}</small>
        <div class="">
          {{$page->body}}
        </div>
        {{-- se i tags di page sono maggiori di 0 allora mostra il contenuto --}}
        @if ($page->tags->count() > 0)
          <div class="">
            <h4>Tags</h4>
            {{-- prendiamo i TAGS di $page, siamo in una collection --}}
              <ul>
                  @foreach ($page->tags as $key => $tag)
                    <li>{{$tag->name}}</li>
                  @endforeach
              </ul>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
