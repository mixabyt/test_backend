<x-layouts.adminpanel :title="'Редагувати статтю'">
<form method="POST" action="{{route('article.update', $article->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container py-5">
        <div class="mb-3">
            <label for="title" class="form-label">Назва статті</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Введіть назву" value="{{$article->title ?? "suda"}}" required>
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
            <label for="tagsInput" class="form-label">Теги</label>
            <div id="tagsContainer" class="mb-2 d-flex flex-wrap gap-2">

            </div>
            <input type="text" class="form-control" id="tagsInput" placeholder="Введіть теги через пробіл">
            <input type="hidden" name="tags[]" id="tagsHidden">
        </div>




        <div class="mb-3">
            <label for="image" class="form-label">Завантажити зображення</label>
            <input type="file" class="form-control" name="image" id="image">

            <div id="imageWrapper" class="mt-3 text-left"
                 @if(!$article->image) style="display:none;" @endif>


                <img id="preview"
                     src="@if($article->image) {{ asset('storage/' . $article->image) }} @endif"
                     alt="article image"
                     style="max-width: 250px; border-radius: 8px; display:block; margin:0;">


                <button type="button" id="deleteImage" class="btn btn-danger btn-sm mt-2">
                    Видалити зображення
                </button>
            </div>

            <input type="hidden" name="delete_image" id="deleteImageFlag" value="0">
        </div>




        <div class="mb-3">
            <label for="content" class="form-label">Текст статті</label>
            <textarea class="form-control" id="content" name="content" rows="10" placeholder="Введіть текст статті" required>{{$article->content ?? "content"}}</textarea>
        </div>


        <div class="form-check m-3">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="flexCheckDefault"
                   @if($article->is_active) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Зробити активною
            </label>
        </div>

        <button type="submit" class="btn btn-success">Редагувати</button>
        <a href="{{route('dashboard')}}" class="btn btn-secondary">Скасувати</a>


    </div>


</form>
    <script>
        const container = document.getElementById('tagsContainer')
        const input = document.getElementById('tagsInput')
        const form = document.querySelector('form');

        let tags = @json(old('tags', $article->tags->pluck('name')))

            function createTagElement(tag) {
                const btn = document.createElement('button')
                btn.type = 'button'
                btn.className = 'btn btn-sm btn-secondary'
                btn.textContent = tag + ' ×'
                btn.addEventListener('click', () => {
                    tags = tags.filter(t => t !== tag)
                    btn.remove()
                    const hiddenInputs = document.querySelectorAll('input[name="tags[]"]')
                    hiddenInputs.forEach(input => {
                        if (input.value === tag) input.remove()
                    })
                })
                return btn
            }

        function updateHiddenInputs() {

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
            const tagEl = createTagElement(tag)
            container.appendChild(tagEl)
        })
        updateHiddenInputs()

        input.addEventListener('keydown', e => {
            if (e.key === ' ') {
                e.preventDefault()
                const tag = input.value.trim()
                if (tag && !tags.includes(tag)) {
                    tags.push(tag)
                    const tagEl = createTagElement(tag)
                    container.appendChild(tagEl)
                    updateHiddenInputs()
                }
                input.value = ''
            }
        })
    </script>
    <script>
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('preview');
        const wrapper = document.getElementById('imageWrapper');
        const deleteBtn = document.getElementById('deleteImage');
        const deleteFlag = document.getElementById('deleteImageFlag');

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                wrapper.style.display = 'block';
                deleteFlag.value = 0;
            }
        });

        deleteBtn.addEventListener('click', function () {
            preview.src = "";
            wrapper.style.display = 'none';
            imageInput.value = "";
            deleteFlag.value = 1;
        });
    </script>
</x-layouts.adminpanel>
