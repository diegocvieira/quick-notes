export default function () {
    return fetch('public/files/notes.json').then(function(response) {
        return response.json();
    }).then(function(notes) {
        let notesNavigationBody = '';
        let notesDataBody = '';

        notes.map(function(note, index) {
            let versions = '';

            note.versions.map(function(version, versionIndex) {
                versions += `
                    <div class="note-version">
                        <button type="button" class="copy-clipboard" title="Copiar">
                            <svg class="copy-clipboard-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"></path>
                                <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"></path>
                            </svg>

                            <svg class="copy-clipboard-icon-active is-hidden" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <h3>${version.title || ''}</h3>

                        <p class="note-version-description">
                            ${version.description}
                        </p>
                    </div>
                `;
            });

            notesNavigationBody += `
                <li>
                    <a href="#${note.slug}" class="navigation-link ${index === 0 ? 'current' : ''}">${note.title}</a>
                </li>
            `;

            notesDataBody += `
                <div class="note ${index === 0 ? 'is-active' : ''}" id="${note.slug}">
                    ${versions}
                </div>
            `;
        });

        let notesNavigationDiv = document.getElementById('js-notes-navigation');
        notesNavigationDiv.innerHTML = notesNavigationBody;

        let notesDataDiv = document.getElementById('js-notes-data');
        notesDataDiv.innerHTML = notesDataBody;
    });
}