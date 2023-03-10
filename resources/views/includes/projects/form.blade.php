

{{-- Form --}}
@if ($project->exists)
  <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" novalidate>
    @method('PUT')
  @else
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" novalidate>
@endif


@csrf

<div class="row">
  <div class="col-6">
    <div class="mb-3">
      <label for="short_name" class="form-label">Nome titolo</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
        placeholder="Nome titolo" name="title" id="title" required value="{{ old('title', $project->title) }}">
      @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @else
        <div class="form-text">Es.: Javascript projects</div>
      @enderror
    </div>
  </div>
  <div class="col-6">
    <div class="mb-3">
      <label for="slug" class="form-label">slug</label>
      <input type="text" class="form-control" id="slug" value="{{Str::slug(old('title', $project->title))}}">
    </div>
  </div>
  <div class="col-11">
    <div class="mb-3">
      <label for="image" class="form-label">Immagine</label>
      <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
        placeholder="image" name="image" required value="{{ old('image', $project->image) }}">
      @error('image')
        <div class="invalid-feedback">
          {{ $msg }}
        </div>
      @else
        <div class="form-text">https:sdsjdksdlfjie.jpg</div>
      @enderror
    </div>
  </div>
  <div class="col-1">
    <img class="img-fluid" id="img-preview" src="{{$project->image ? asset('storage/'. $project->image) :'https://marcolanci.it/utils/placeholder.jpg'}}" alt="">
  </div>
 
  
  </div>
  <div class="col-12">
    <div class="mb-3">
      <label for="content" class="form-label">Descrizione</label>
      <textarea name="content" id="content" cols="30"
        class="form-control @error('content') is-invalid @enderror">{{ old('content', $project->content) }}</textarea>
    </div>
  </div>
  
<hr>
<div class="d-flex justify-content-end">
  <button type="submit" class="btn btn-success">Salva</button>
</div>
</form>

@section('scripts')
<script>
  const slugInput = document.getElementById('slug');
  const titleInput = document.getElementById('title');

  titleInput.addEventListener('blur', () =>{
    slugInput.value = titleInput.value.toLowerCase().split(' ').join('-');

  })

</script>

<script>
const placeholder = 'https://marcolanci.it/utils/placeholder.jpg';
const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('img-preview');
imageInput.addEventListener('change', ()=>{
  if(imageInput.files && imageInput.files[0]){
    let reader = new FileReader();
    reader.readAsDataUrl(imageInput.files[0]);
    reader.onload = e => {
      imagePreview.src = e.target.result;
    }
  } else imagePreview.setAttribute('src',  placeholder);
})
</script>
@endsection