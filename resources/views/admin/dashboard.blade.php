<x-layouts.adminpanel :title="'Адмін панель'">

    <div class="container my-4">
        <a href="{{route('article.create')}}" class="m-3 btn btn-secondary btn-lg">Створити новину</a>
        <div class="row g-4">

            @foreach($articles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-img-top article-image"
                             style="background-image: {{ $article->image ? 'url(' . asset('storage/' . $article->image) . ')' : 'none' }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$article->title}}</h5>
                            <p class="text-muted mb-2">{{$article->created_at}}</p>
                            <div class="d-flex gap-2">
                                <a href="{{route('article.edit', $article->id)}}" class="btn btn-success">Редагувати</a>

                                <form method="POST" action="{{route('article.destroy', $article->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Видалити</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>


</x-layouts.adminpanel>
