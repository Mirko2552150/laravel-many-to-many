@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <form class="" action="{{route('admin.pages.store')}}" method="post">
          @csrf
          @method('POST')
          @foreach ($errors->all() as $key => $message)
            {{$message}}
          @endforeach
          <div class="form-group">
            <label for="title">Titolo</label>
            <input class="form-control" type="text" name="title" id="title" value="{{old('title')}}">
          </div>
          <div class="form-group">
            <label for="summary">Sommario</label>
            <input class="form-control" type="text" name="summary" id="summary" value="{{old('summary')}}">
          </div>
          <div class="form-group">
            <label for="body">Testo</label>
            <textarea class="form-control" name="body" id="body" rows="8" cols="80">{{old('body')}}</textarea>
          </div>
          <div class="form-group">
            <label for="category_id">Categoria</label>
            <select name="category_id" id="category_id">
              @foreach ($categories as $key => $category)
                <option value="{{$category->id}}"
                {{(!empty(old('category_id'))) ? 'selected' : '' }}>
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
              {{-- se tags e' un ARRAY e controlliamo se tag->id e' presente nel nostro array --}}
              {{(is_array(old('tags')) && in_array($tag->id, old('tags'))) ? 'checked' : ''}}>
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
