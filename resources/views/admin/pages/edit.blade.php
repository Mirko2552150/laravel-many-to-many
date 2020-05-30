@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <form class="" action="{{route('admin.pages.update', $page->id)}}" method="POST">
          @csrf
          @method('PATCH')
          @foreach ($errors->all() as $key => $message)
            {{$message}}
          @endforeach
          <div class="form-group">
            <label for="title">Titolo</label>
            {{-- se e' presente OLD inseriscilo altrimenti metti il titolo prensente del DB --}}
            <input class="form-control" type="text" name="title" id="title" value="{{old('title') ?? $page->title}}">
          </div>
          <div class="form-group">
            <label for="summary">Sommario</label>
            <input class="form-control" type="text" name="summary" id="summary" value="{{old('summary') ?? $page->summary}}">
          </div>
          <div class="form-group">
            <label for="body">Testo</label>
            <textarea class="form-control" name="body" id="body" rows="8" cols="80">{{old('body') ?? $page->body}}</textarea>
          </div>
          <div class="form-group">
            <label for="category_id">Categoria</label>
            <select name="category_id" id="category_id">
              @foreach ($categories as $key => $category)
                <option value="{{$category->id}}"
                  {{-- controlliamo ad ogni giro che se la CAT che stiamo stampando e' = a quella del DB --}}
                {{(!empty(old('category_id')) || $category->id == $page->category->id) ? 'selected' : '' }}>
                {{$category->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <h3>Tags</h3>
            @foreach ($tags as $key => $tag)
              <label for="tags-{{$tag->id}}">{{$tag->name}}</label>
              {{-- nell input ci aspettiamo un ARRAY (name=tags[])  --}}
              <input type="checkbox" name="tags[]" id="tags-{{$tag->id}}" value="{{$tag->id}}"
              {{-- controllo se old e' un ARRAY e se tag->id del record PAGE e' presente nella selezione dell'utente salvata, cosi da poter ritornare il CHECK mantenuto buono OPPURE prende il valore dal DB se una di queste 2 condizione e vera CHECK --}}
              {{((is_array(old('tags')) && in_array($tag->id, old('tags'))) || $page->tags->contains($tag->id)) ? 'checked' : ''}}>
            @endforeach
          </div>
          <div class="form-group">
            <h3>Phots</h3>
              @foreach ($photos as $key => $photo)
                <label for="tag-{{$photo->id}}">{{$photo->name}}</label>
                {{-- mettiamo tra le [] il name, cosi da creare un Arrey dei risultati, restituira il N ID del TAG selezionato--}}
                <input type="checkbox" name="photos[]" id="tag-{{$photo->id}}" value="{{$photo->id}}">
              @endforeach
          </div>
          <input type="submit" value="Salva" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>
@endsection
