<x-layouts.adminpanel :title="'Створити статтю'">
<div class="container py-5">
    <div class="mb-3">
        <label for="title" class="form-label">Назва статті</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Введіть назву" required>
    </div>


    <div class="mb-3">
        <label for="tagsInput" class="form-label">Теги</label>
        <div id="tagsContainer" class="mb-2 d-flex flex-wrap gap-2">

        </div>
        <input type="text" class="form-control" id="tagsInput" placeholder="Введіть теги через пробіл">
        <input type="hidden" name="tags" id="tagsHidden">
    </div>

    <script>
        const input = document.getElementById('tagsInput');
        const container = document.getElementById('tagsContainer');
        // const hiddenInput = document.getElementById('tagsHidden');
        let tags = [];

        // function updateHiddenInput() {
        //     hiddenInput.value = tags.join(',');
        // }

        function createTagElement(tag) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn btn-sm btn-secondary';
            btn.textContent = tag + ' ×';
            btn.addEventListener('click', () => {
                tags = tags.filter(t => t !== tag);
                container.removeChild(btn);
            });
            console.log(tags)
            return btn;
        }

        input.addEventListener('keydown', (e) => {
            if (e.key === ' ') {
                e.preventDefault();
                const tag = input.value.trim();
                if (tag && !tags.includes(tag)) {
                    tags.push(tag);
                    const tagEl = createTagElement(tag);
                    container.appendChild(tagEl);
                    // updateHiddenInput();
                }
                input.value = '';
            }
        });
    </script>


    <div class="mb-3">
        <label for="image" class="form-label">Завантажити картинку</label>
        <input class="form-control" type="file" id="image" name="image" accept="image/*">
    </div>


    <div class="mb-3">
        <label for="content" class="form-label">Текст статті</label>
        <textarea class="form-control" id="content" name="content" rows="10" placeholder="Введіть текст статті" required></textarea>
    </div>


    <button type="submit" class="btn btn-primary">Створити</button>
    <a href="{{route('dashboard')}}" class="btn btn-secondary">Скасувати</a>
</div>

</x-layouts.adminpanel>




