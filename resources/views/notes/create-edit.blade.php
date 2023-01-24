<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quick Notes</title>

        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
        <script src="https://cdn.tiny.cloud/1/8evfgd1vte7qkjemk64wfirv0pwqm6hjdi9t45zmzfd6m39f/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    </head>
    <body>
        <main>
            @if(isset($note))
            <form method="POST" action="{{ route('note.update', $note->id) }}">
                @method('PUT')
            @else
            <form method="POST" action="{{ route('note.store') }}">
            @endif
                @csrf

                <div class="group">
                    <input type="text" name="title" value="{{ $note->title ?? '' }}" required />
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Título</label>
                </div>

                <button type="button" id="add-note-version">ADD</button>
                <div class="versions">
                    @if (isset($note))
                        @foreach ($note->versions as $version)
                            <div class="version">
                                <input type="text" name="versions_title[]" placeholder="Título da versão" value="{{ $version->title }}" />
                                <textarea name="versions_description[]">{{ $version->description }}</textarea>
                            </div>
                        @endforeach
                    @else
                        <div class="version">
                            <input type="text" name="versions_title[]" placeholder="Título da versão" />
                            <textarea name="versions_description[]"></textarea>
                        </div>
                    @endif
                </div>

                <button type="submit">SALVAR</button>
            </form>
        </main>

        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                skin: "oxide-dark",
                content_css: "dark"
            });

            const addNoteVersionButton = document.getElementById('add-note-version');
            addNoteVersionButton.addEventListener('click', event => {
                event.preventDefault();

                // Get the element
                var elements = document.querySelectorAll('.version');
                var elem = elements[elements.length - 1];

                // Create a copy of it
                var clone = elem.cloneNode(true);

                // Update the ID and add a class
                // clone.id = 'elem2';
                // clone.classList.add('text-large');

                // Inject it into the DOM
                elem.after(clone);

                console.log('click');

                tinymce.init({
                    selector: 'textarea',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                    skin: "oxide-dark",
                    content_css: "dark"
                });
            });

        </script>
    </body>
</html>
