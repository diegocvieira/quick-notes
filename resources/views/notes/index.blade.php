<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quick Notes</title>

        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
    </head>
    <body class="antialiased">
        <main>
            <nav>
                <ul>
                    @foreach ($notes as $note)
                        <li>
                            <a href="#{{ $note->slug }}" class="navigation-link {{ $loop->first ? 'current' : '' }}">{{ $note->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="notes">
                @foreach ($notes as $note)
                    <div class="note {{ $loop->first ? 'is-active' : '' }}" id="{{ $note->slug }}">
                        @foreach ($note->versions as $version)
                            <div class="note-version">
                                <button type="button" class="copy-clipboard">
                                    <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"></path>
                                        <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"></path>
                                    </svg>

                                    <!-- <svg fill="currentColor" class="fill-current text-white h-5 w-5" viewBox="0 0 20 20">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg> -->
                                </button>

                                <div class="note-version-description">
                                    {!! $version->description !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </main>

        <script>
            const copy = document.querySelectorAll('.copy-clipboard');
            copy.forEach(el => el.addEventListener('click', event => {
                event.preventDefault();

                const copyText = document.querySelectorAll('.text.is-active .version-description')[0];
                const range = document.createRange();
                range.selectNode(copyText);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.execCommand('copy');
                window.getSelection().removeAllRanges();
            }));

            const navigationLinks = document.querySelectorAll('.navigation-link');
            navigationLinks.forEach(element => element.addEventListener('click', event => {
                event.preventDefault();

                navigationLinks.forEach(link => link.classList.remove('current'));
                event.target.classList.add('current');

                const notes = document.querySelectorAll('.note');
                notes.forEach(element => element.classList.remove('is-active'));

                const text = document.getElementById(event.target.hash.replace('#', ''));
                text.classList.add('is-active');
            }));
        </script>
    </body>
</html>
