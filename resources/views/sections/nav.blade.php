<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" aria-current="page" href="{{route('home')}}">
                    <i class="fa fa-home"></i>
                    Accueil
                </a>
            </li>
        </ul>

        <!-- start category of file-->
        
        <h6
            class="sidebar-heading bg-secondary text-white py-1 d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
            <span> <i class="fa fa-th"></i>  Categories</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
           
            <li class="nav-item">
                <a class="nav-link  {{ (request('category')=='bilan') ? 'active' : '' }}" href="/document?category=bilan">
                    <i class="fa fa-angle-right"></i>
                    Bilan 
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ (request('category')=='rapport') ? 'active' : '' }}" href="/document?category=rapport">
                    <i class="fa fa-angle-right"></i>
                    Rapport 
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ (request('category')=='note analyse') ? 'active' : '' }}" href="/document?category=note analyse">
                    <i class="fa fa-angle-right"></i>
                    Note d'analyse 
                </a>
            </li>
        </ul>
<!-- end category of file-->

   <!-- start category of file-->
   <h6
   class="sidebar-heading bg-secondary text-white py-1 d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
   <span> <i class="fa fa-folder"></i>  Gestion des documents</span>
   <a class="link-secondary" href="#" aria-label="Add a new report">
       <span data-feather="plus-circle"></span>
   </a>
</h6>
<ul class="nav flex-column mb-2">
  
   {{-- <li class="nav-item">
       <a class="nav-link" href="#">
           Ajouter une categorie
       </a>
   </li> --}}

   <li class="nav-item">
       <a class="nav-link {{ (request()->is('document/index')) ? 'active' : '' }}" href="{{route('document.index')}}">
          <i class="fa fa-angle-right"></i> Ajouter un document 
       </a>
   </li>

  
</ul>
<!-- end category of file-->


    </div>
</nav>