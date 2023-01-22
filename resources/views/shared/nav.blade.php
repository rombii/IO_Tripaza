<h1 class="display-1 mx-auto text-center mb-3"><a href="{{route('index')}}" class="text-decoration-none text-black">Tripaza</a></h1>
<div class="row justify-content-between">
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fw-bold">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if(Request::is('lastminute')) text-white @endif" href="{{route('lastminute')}}">Last Minute</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::is('summer')) text-white @endif" href="{{route('summer')}}">Summer 2022</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::is('winter')) text-white @endif" href="{{route('winter')}}">Winter 2022/2023</a>
                    </li>
                  <li class="nav-item">
                    <a class="nav-link @if(Request::is('all')) text-white @endif" href="{{route('all')}}">All trips</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @if(Request::is('support')) text-white @endif" href="{{route('support')}}">Support</a>
                  </li>
                </ul>
                <a class="navbar-brand" href="@if (Auth::check())
                    {{route('userpage')}}
                @else
                    {{route('login')}}
                @endif">
                    {{-- @if ($request->session()->exists('users'))
                        <p>Welcome!</p>
                    @endif --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                      </svg>
                </a>
              </div>
            </div>
          </nav>
    </div>
</div>
