<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Video </title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Video</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <!-- Anda dapat menambahkan item navbar lainnya di sini jika diperlukan -->
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="form-inline my-2 my-lg-0">
                    <a class="btn btn-light mr-1" href="{{ route('vidio.create') }}">Add</a>
                    @csrf
                    <button class="btn btn-danger my-2 my-sm-0" type="submit">{{ __('Logout') }}</button>
                </form>
            </div>
        </div>
    </nav>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item {{ ($videos->currentPage() == 1) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $videos->url(1) }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for ($i = 1; $i <= $videos->lastPage(); $i++)
                <li class="page-item {{ ($videos->currentPage() == $i) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $videos->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ ($videos->currentPage() == $videos->lastPage()) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $videos->url($videos->currentPage() + 1) }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>


    <div class="container text-center">
        <h2 class="text-center">Feed</h2>
        @foreach ($videos as $video)
            <div class="position-relative d-inline-block">
                <video width="640" height="360" controls class="card-img-top">
                    <source src="{{ asset('/video/'.$video->video)}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <form action="{{ route('vidio.destroy',$video->id) }}" method="POST" class="position-absolute" style="top: 10px; right: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin video ini?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            </div>
            <div class="text-center mt-2">
                <div>{{ $video->caption }}</div>
                <div>{{ $video->created_at->format('d F Y') }}</div>
            </div>
            <br>
        @endforeach
    </div>
    

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
