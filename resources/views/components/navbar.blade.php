<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand navbar-center-brand" href="/">Rimiga</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Genres
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/genre?genreName=Action">Action</a></li>
                        <li><a class="dropdown-item" href="/genre?genreName=Adventure">Adventure</a></li>
                        <li><a class="dropdown-item" href="/genre?genreName=RPG">RPG</a></li>
                        <li><a class="dropdown-item" href="/genre?genreName=Strategy">Strategy</a></li>
                        <li><a class="dropdown-item" href="/genre?genreName=Simulation">Simulation</a></li>
                        <li><a class="dropdown-item" href="/genre?genreName=Sports">Sports</a></li>
                        <li><a class="dropdown-item" href="/genre?genreName=Racing">Racing</a></li>
                        <li><a class="dropdown-item" href="/genre?genreName=Indie">Indie</a></li>
                        <li><a class="dropdown-item" href="/genre?genreName=Casual">Casual</a></li>
                        <li><a class="dropdown-item" href="/genre?genreName=Massively Multiplayer">Massively Multiplayer</a></li>
                        <li><a class="dropdown-item" href="/genre?genreName=Free to Play">Free to Play</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/favourites">Favourites</a>
                </li>
            </ul>

            @if(auth()->check())
                <div class="dropdown me-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="labels nav-username">{{ auth()->user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form method="POST" action="/logout" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="/login" class="me-3"><button class="log-in-nav">Log In</button></a>
            @endif

            <form class="d-flex" role="search" method="post" action="/search">
                @csrf
                <input class="form-control me-2" name="gameName" type="search" placeholder="Search" aria-label="Search"/>
            </form>
        </div>
    </div>
</nav>