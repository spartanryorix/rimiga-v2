<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rimiga: Sign Up</title>
    <link rel="stylesheet" href="{{ asset('css/login&signupStyle.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="body">
    <div class="hero-section">
        <div class="hero-overlay">
            <div id='stars'></div>
            <div id='stars2'></div>
            <div id='stars3'></div>
        </div>
        <div class="hero-content">
            <h1 class="heading" id="title"><span>Rimiga</span></h1>
            <p class="subHeading" id="title"><span>Dive into the realm of PC gaming</span></p>
            <div class="d-flex align-items-center justify-content-center" style="min-height: 50vh;">
                <div class="card outerCard" style="margin-top: 20px;">
                    <form method="POST" action="/register">
                        @csrf
                        <p class="subHeading">Sign Up</p>
                        
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <label class="labels" for="username">Username</label>
                        <input class="form-control" type="text" id="username" name="username" value="{{ old('username') }}" required>
                        
                        <label class="labels" for="email">Email</label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required>
                        
                        <label class="labels" for="password">Password</label>
                        <input class="form-control" type="password" id="password" name="password" required>
                                                
                        <button class="submitBtn w-100" type="submit">Submit</button>
                        <a href="/login"><p class="labelsSignup">Already a part of the realm? Click here to log back in!</p></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>