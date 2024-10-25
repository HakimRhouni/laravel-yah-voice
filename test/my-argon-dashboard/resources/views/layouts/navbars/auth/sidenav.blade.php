<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a  href="{{ route('home') }}"
            target="_blank">
            <!-- Mise à jour du chemin vers l'image -->
            <img src="{{ asset('img/yah-voice.png') }}" alt="Logo" class="img-fluid" style="margin-left: 40px">
           
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    
                        
                        <i class="text-primary text-sm opacity-10"></i>
                    
                    <span class="nav-link-text ms-2">Compain List</span>
                </a>
            </li>
            
        </ul>
    </div>
</aside>
