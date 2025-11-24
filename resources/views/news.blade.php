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
                        <h5 class="card-title text-nowrap text-truncate">{{ $article->title }}</h5>
                        <p class="text-muted mb-2">{{ $article->created_at }}</p>

                        <div class="d-flex justify-content-between">
                            <a class="btn btn-primary" href="{{ route('new.page', $article->id) }}">Читати</a>

                            @if(auth()->check() && (auth()->id() === $article->user_id || auth()->user()->role === 'admin'))
                                <div class="d-flex gap-2">
                                    <a class="btn btn-success" href="{{ route('article.edit', $article->id) }}">Редагувати</a>
                                    <form method="POST" action="{{ route('article.destroy', $article->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="confirmation(event)" type="submit" class="btn btn-danger">Видалити</button>
                                    </form>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
    <div class="d-flex justify-content-center my-4">
        {{ $articles->links('pagination::bootstrap-5') }}
    </div>


    <script type="text/javascript">
        function confirmation(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Видалити?',
                text: "Ви точно хочете видалити цю статтю? Ця дія незворотня",
                // icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Так',
                cancelButtonText: 'Ні'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
        }
    </script>
</x-layouts.adminpanel>

