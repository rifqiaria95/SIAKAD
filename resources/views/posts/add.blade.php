@extends('master.template')
<style>
    .ck-editor__editable {
        min-height: 300px;
    }
</style>
@section('master.intro-header')

<div class="main-wrapper">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Post</h5>
                    <form class="row g-3" id="formSiswa" action="{{route('posts.create')}}" method="POST">
                        @csrf
                        <div class="col-6" {{ $errors->has('title') ? 'has-error' : '' }}>
                            <input name="title" type="text" class="form-control" placeholder="Title Post (Wajib Diisi)" aria-label="First name" value="{{old('title')}}" required>
                            @if($errors->has('title'))
                                <span class="help-block">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fas fa-camera m-r-xxs"></i>Pilih Gambar
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="thumbnail" placeholder="Thumbnail Wajib Diupload" required>
                            </div>
                            <img id="holder" style="margin-top:15px;max-height:100px;">
                        </div>
                        <div class="col-12 form-group">
                            <label for="examplelabel"></label>
                            <textarea name="content" id="content" cols="30" rows="10"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="{{ asset('frontend/js/ckeditor.js') }}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );

    $( document ).ready(function() {
        // console.log( "ready!" );
        $('#lfm').filemanager('image');
    });
</script>

@endsection