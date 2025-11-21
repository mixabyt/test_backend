
<x-layouts.adminpanel :title="'Новини'">
    <div class="container my-4">
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
                        <a type="button" class="btn btn-primary" href="{{route('new.page',$article->id)}}">Читати</a>
                    </div>
                </div>
            </div>
            @endforeach




        </div>
    </div>
</x-layouts.adminpanel>

