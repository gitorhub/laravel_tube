
@if (count($errors))
@foreach ($errors->all() as $error)
<div class="alert alert-danger text-center" role="alert">
  {{$error}}      
</div>
@endforeach    
@endif

@if (session('success'))
<div class="alert alert-success text-center" role="alert">
  {{session('success')}}      
</div>    
@endif

@if (session('error'))
<div class="alert alert-danger text-center" role="alert">
  {{session('error')}}      
</div>     
@endif
