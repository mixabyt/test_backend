<x-layouts.adminpanel :title="'Створити статтю'">
    <form method="POST" action="{{route('article.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="container py-5">
            <div class="mb-3">
                <label for="title" class="form-label">Назва статті</label>
                <input type="text" value="{{ old('title') }}" class="form-control" id="title" name="title"
                       placeholder="Введіть назву" required>
            </div>


            <div class="mb-3">
                <label for="tagsInput" class="form-label">Теги</label>
                <div id="tagsContainer" class="mb-2 d-flex flex-wrap gap-2">

                </div>
                <input type="text" class="form-control" id="tagsInput" placeholder="Введіть теги через пробіл">
                <input type="hidden" name="tags[]" id="tagsHidden">
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif



            <div class="mb-3">
                <label for="image" class="form-label">Завантажити картинку</label>
                <input class="form-control" type="file" id="image" value="{{old('image')}}" name="image"
                       accept="image/*">
            </div>


            <div class="mb-3">
                <label for="content" class="form-label">Текст статті</label>
                <textarea class="form-control" id="content" name="content" rows="10" placeholder="Введіть текст статті"
                          required>{{old('content')}}</textarea>
            </div>
            <div class="form-check m-3">
                <input type="hidden" name="is_active" value="0">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="flexCheckDefault"
                       checked>
                <label class="form-check-label" for="flexCheckDefault">
                    Зробити активною
                </label>
            </div>


            <button type="submit" class="btn btn-primary">Створити</button>
            <a href="{{route('dashboard')}}" class="btn btn-secondary">Скасувати</a>
        </div>
    </form>

    <script>
        let tags = @json(old('tags', []));
        const container = document.getElementById('tagsContainer');

        function createTagElement(tag) {
            const btn = document.createElement('button')
            btn.type = 'button'
            btn.className = 'btn btn-sm btn-secondary'
            btn.textContent = tag + ' ×'
            btn.addEventListener('click', () => {
                tags = tags.filter(t => t !== tag)
                btn.remove();
                const hiddenInputs = document.querySelectorAll('input[name="tags[]"]')
                hiddenInputs.forEach(input => {
                    if (input.value === tag) {
                        input.remove()
                    }
                })
            })
            return btn
        }

        const hiddenInput = document.getElementById('tagsHidden');

        function updateHiddenInput() {

            document.querySelectorAll('input[name="tags[]"]').forEach(i => i.remove());

            tags.forEach(tag => {
                const inputEl = document.createElement('input');
                inputEl.type = 'hidden';
                inputEl.name = 'tags[]';
                inputEl.value = tag;
                container.appendChild(inputEl);
            });
        }


        tags.forEach(tag => {
            const tagEl = createTagElement(tag);
            container.appendChild(tagEl);
        });
        updateHiddenInput();


        const input = document.getElementById('tagsInput');
        input.addEventListener('keydown', (e) => {
            if (e.key === ' ') {
                e.preventDefault();
                const tag = input.value.trim();
                if (tag && !tags.includes(tag)) {
                    tags.push(tag);
                    const tagEl = createTagElement(tag);
                    container.appendChild(tagEl);
                    updateHiddenInput();
                }
                input.value = '';
            }
        });
    </script>

</x-layouts.adminpanel>




