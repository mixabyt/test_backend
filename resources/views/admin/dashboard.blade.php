
<x-layouts.adminpanel :title="'Адмін панель'">

    <div class="container my-4">
        <a href="{{route('article.create')}}" class="m-3 btn btn-secondary btn-lg">Створити новину</a>
        <div class="row g-4">

            @foreach($articles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <img src="{{$article->image}}" class="card-img-top" alt="Фото">
                        <div class="card-body">
                            <h5 class="card-title">{{$article->title}}</h5>
                            <p class="text-muted mb-2">{{$article->created_at}}</p>
                            <div class="d-flex gap-2">
                                <a href="{{route('article.edit', 1)}}" class="btn btn-success">Редагувати</a>

                                <form method="POST" action="{{route('article.destroy', 1)}}">
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
