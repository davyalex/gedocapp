<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{route('home')}}"><i class="fa fa-folder-open" aria-hidden="true"></i>  GEDOC@APP</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="recherche" aria-label="Search">
    <div class="navbar-nav">
        <div class="nav-item text-nowrap" style="position:relative" >
            <a class="nav-link px-5 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" href="#"> <i class="fa fa-user"></i> {{Auth::user()->name}} </a>
            <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
               
                <li class="nav-item dropdown">
                  {{-- <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    User
                  </a> --}}
                  <ul class="dropdown-menu" style="position:absolute">
                    {{-- <li><a class="dropdown-item" href="#">Another action</a></li> --}}
                    {{-- <li>
                      <hr class="dropdown-divider">
                    </li> --}}
                    <li><a class="dropdown-item text-danger" href="{{route('logout')}}"> <i class="fa fa-sign-out"></i>  Deconnexion</a></li>
                  </ul>
                </li>
              </ul>
            
              
        </div>
    </div>
    
    
</header>
