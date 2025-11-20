
<x-layouts.adminpanel :title="'Адмін панель'">

    <div class="container my-4">
        <a href="{{route('article.create')}}" class="m-3 btn btn-secondary btn-lg">Створити новину</a>
        <div class="row g-4">

            <!-- Article card -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100">
                    <img src="https://images.unian.net/photos/2025_05/1746178730-5591.jpg" class="card-img-top" alt="Фото">
                    <div class="card-body">
                        <h5 class="card-title">Назва статті</h5>
                        <p class="text-muted mb-2">01.01.2025</p>
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


            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100">
                    <img src="https://i.imgur.com/qXgL3si.jpeg" class="card-img-top" alt="Фото">
                    <div class="card-body">
                        <h5 class="card-title">Назва статті</h5>
                        <p class="text-muted mb-2">01.01.2025</p>
                        <a href="#" class="btn btn-success">Редагувати</a>
                        <a href="#" class="btn btn-danger">Видалити</a>
                    </div>
                </div>
            </div>


            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100">
                    <img src="https://i.imgur.com/qXgL3si.jpeg" class="card-img-top" alt="Фото">
                    <div class="card-body">
                        <h5 class="card-title">Назва статті</h5>
                        <p class="text-muted mb-2">01.01.2025</p>
                        <a href="#" class="btn btn-success">Редагувати</a>
                        <a href="#" class="btn btn-danger">Видалити</a>
                    </div>
                </div>
            </div>

        </div>
    </div>


</x-layouts.adminpanel>
