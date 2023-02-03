export default function () {
    const navigationLinks = document.querySelectorAll('.navigation-link');
    navigationLinks.forEach(element => element.addEventListener('click', event => {
        event.preventDefault();

        navigationLinks.forEach(link => link.classList.remove('current'));
        event.target.classList.add('current');

        const notes = document.querySelectorAll('.note');
        notes.forEach(link => link.classList.remove('is-active'));

        const text = document.getElementById(event.target.hash.replace('#', ''));
        text.classList.add('is-active');
    }));
}