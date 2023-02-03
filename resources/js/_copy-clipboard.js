export default function () {
    const copyClipboardButtons = document.querySelectorAll('.copy-clipboard');

    copyClipboardButtons.forEach(element => element.addEventListener('click', event => {
        event.preventDefault();

        copy(event);
    }));

    function copy(event) {
        const text = event.currentTarget.nextElementSibling.nextElementSibling;
        const range = document.createRange();

        range.selectNode(text);
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);

        const copySuccessful = document.execCommand('copy');

        if (copySuccessful) {
            changeIcon();
        }

        window.getSelection().removeAllRanges();
    }

    function changeIcon() {
        const iconCopy = document.querySelectorAll('.note.is-active .copy-clipboard-icon')[0];
        const iconCopied = document.querySelectorAll('.note.is-active .copy-clipboard-icon-active')[0];

        iconCopy.style.display = 'none';
        iconCopied.style.display = 'block';

        setTimeout(() => {
            iconCopy.style.display = 'block';
            iconCopied.style.display = 'none';
        }, 3000);
    }
}