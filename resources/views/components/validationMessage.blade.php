  <!-- start message validation-->
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible fade show text-white" role="alert"
      style="background-color:rgb(9, 156, 9)">
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

@elseif ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show text-white" role="alert"
style="background-color:rgb(192, 58, 58)">
{{ $message }}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


@endif
<!-- end message validation-->