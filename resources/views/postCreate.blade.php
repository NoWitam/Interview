@extends('layout')

@section('tittle')
Utwórz post 
@endsection

@section('body')
<form method="POST" 
 @if( isset($edit) AND $edit == true)
     action="{{ route('post.edit') }}"
 @else
      action="{{ route('post.create') }}"
 @endif
>
   {{ csrf_field() }}
   @if( isset($edit) AND $edit == true)
        <input type="hidden" name="id" value="{{ $postId }}">
    @endif
   <label> Treść: </label>
   <br>
   <textarea name="content" rows="4" cols="50" maxlength="1500" required="required">
       @if( isset($edit) AND $edit == true)
           {{ $postContent }}
       @endif
   </textarea>

   <br>
   <br>

   <label> Kategorie: </label>
   <br>
   <select name='categories[]' multiple>
       @foreach($categories as $category)
          <option value="{{ $category->id }}" 
            @if(isset($edit) AND $edit == true AND in_array($category->id, $postCategoriesId))
               selected
            @endif  
            >
              {{ $category->name }}
          </option>
       @endforeach
   </select>

   <br>
   <br>

   <input type="submit" value="
      @if(isset($edit) AND $edit == true)
         Edytuj post
      @else
         Dodaj post  
      @endif
   ">
</form>
@endsection
