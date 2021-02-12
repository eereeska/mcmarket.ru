class Editor {
    constructor(editor) {
        this.editor = editor;
        this.name = this.editor.dataset.name;
        this.input = this.initInput();

        if (this.input.value.length > 0) {
            this.editor.innerHTML = this.input.value;
        }

        document.execCommand('defaultParagraphSeparator', false, 'p');

        editor.addEventListener('keyup', this.inputHandler.bind(this));
        editor.addEventListener('focus', this.inputHandler.bind(this));
        editor.addEventListener('paste', this.pasteHandler.bind(this));
    }

    initInput() {
        var input = this.editor.parentNode.querySelector('input[name="' + this.name + '"]');

        if (!input || input.length < 1) {
            input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', this.name);
            
            input.required = this.editor.dataset.required
            
            this.editor.parentNode.appendChild(input);
        }

        return input;
    }

    inputHandler() {
        if (this.editor.innerHTML === '<br>') {
            this.editor.innerHTML = '';
        }

        if (!this.editor.innerHTML.match(/<.*>/)) {
            setTimeout(function() {
                document.execCommand('formatBlock', false, 'p');
            }, 0);
        }

        this.updateInput();
    }

    pasteHandler(e) {
        e.preventDefault();
        document.execCommand('insertHTML', false, e.clipboardData.getData('text/plain'));
    }

    updateInput() {
        this.input.value = this.editor.innerHTML.trim();
    }
}

document.querySelectorAll('[contenteditable][data-name]').forEach(function(editor) {
    new Editor(editor);
});