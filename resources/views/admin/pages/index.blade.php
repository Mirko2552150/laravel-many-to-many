@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <ul class="nav justify-content-center">
            <li class="nav-item">
               <a class="nav-link active" href="{{route('home')}}">Torna alla dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('admin.pages.create')}}">Aggiungi Pagina</a>
            </li>
          </ul>
        <table class="table table-dark">
          <thead>
            <tr>
              <th>Id</th>
              <th>Titolo</th>
              <th>Categoria</th>
              <th>Tags</th>
              <th>Data Creazione</th>
              <th>Data Update</th>
              <th colspan="3">Azioni</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pages as $key => $page)
              <tr>
                <td>{{$page->id}}</td>
                <td>{{$page->title}}</td>
                <td>{{$page->category->name}}</td>
                <td>
                  {{-- tags a diff degli altri e' una collection, quindi foreach --}}
                  @foreach ($page->tags as $key => $tag)
                    {{$tag->name}}
                  @endforeach
                </td>
                <td>{{$page->created_at}}</td>
                <td>{{$page->update_at}}</td>
                <td><a class="btn btn-primary" href="{{route('admin.pages.show', $page->id)}}">Visualizza</a></td>
                <td>Modifica</td>
                <td>Elimina</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
