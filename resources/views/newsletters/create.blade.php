<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="alternate" href="{{mix('css/app.css')}}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Newsletter</title>
</head>
<body>
    <div class="container d-flex h-100">
        <div class="row align-self-center w-100">
            <div class="col-12 mx-auto">
                <h1 class="text-center">
                    Newsletter
                </h1>
                <form action="{{route('newsletters.store')}}" method="post" class="text-center">
                    @csrf
                    <input type="email" name="email" id="email" placeholder="Enter email">
                    <button type="submit" class="btn btn-success btn-sm px-3">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>