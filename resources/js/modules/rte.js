import mcm from "../mcm";

class Editor {
    constructor(editor) {
        this.editor = editor;
        this.name = this.editor.dataset.name;
        this.input = this.initInput();

        document.execCommand('defaultParagraphSeparator', false, 'p');

        editor.addEventListener('keyup', this.inputHandler.bind(this));
        editor.addEventListener('focus', this.inputHandler.bind(this));
        editor.addEventListener('paste', this.pasteHandler.bind(this));

        this.editor.parentNode.querySelectorAll('.editor__toolbar > button').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                document.execCommand(e.target.dataset.command, false);
            });
        });
    }

    initInput() {
        var input = this.editor.parentNode.querySelector('input[name="' + this.name + '"]');

        if (!input) {
            input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', this.name);
            
            input.required = this.editor.dataset.required
            
            this.editor.parentNode.appendChild(input);
        }

        input.value = this.editor.innerHTML.trim();

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

        this.input.value = this.editor.innerHTML.trim();
    }

    pasteHandler(e) {
        e.preventDefault();
        document.execCommand('insertHTML', false, e.clipboardData.getData('text/plain'));
    }
}

mcm.qsa('[contenteditable][data-name]').forEach(function(editor) {
    new Editor(editor);
});