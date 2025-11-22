<x-layouts.adminpanel :title="$article->title">
    <div class="container py-4">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('news')}}">Домашня сторінка</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$article->title}}</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <h1 class="mb-3">{{ $article->title }}</h1>

                <p class="text-muted" >
                    {{ $article->created_at }}
                </p>


                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}"
                         alt="{{ $article->title }}"
                         class="img-fluid rounded mb-4">
{{--                @else--}}
{{--                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded mb-4"--}}
{{--                         style="height: 300px;">--}}
{{--                        <span>Фото відсутнє</span>--}}
{{--                    </div>--}}
                @endif


                <div class="article-content fs-5 text-justify-md">
                    {{$article->content}}
                </div>

            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">

            @if($prev)
                <a href="{{route('new.page', $prev->id)}}" class="btn btn-outline-primary">
                    ← Попередня новина
                </a>
            @else
                <div></div>
            @endif
            @if($next)
            <a href="{{route('new.page', $next->id)}}" class="btn btn-outline-primary">
                 Попередня новина →
            </a>
            @else
                <div></div>
            @endif


        </div>

    </div>




</x-layouts.adminpanel>
