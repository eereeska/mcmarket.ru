// window._ = require('lodash');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.mcm = {
    imageViewer: () => {
        return {
            url: '',
            dragOver: false,
    
            fileChosen(event) {
                this.url = event.target.files.length ? URL.createObjectURL(event.target.files[0]) : null
            },

            drop(event) {
                this.dragOver = false

                if (!event.dataTransfer.files.length || !event.dataTransfer.files[0].type.match('image/*')) {
                    return
                }

                this.$refs.cover.files = event.dataTransfer.files
                this.url = event.dataTransfer.files.length ? URL.createObjectURL(event.dataTransfer.files[0]) : null
            },
        }
    },
    editor: () => {
        return {
            inputValue: '',

            inputHandler(event) {
                
                if (!this.inputValue.match(/<.*>/)) {
                    document.execCommand('formatBlock', false, 'p')
                }
                
                if (this.inputValue === '<br>' || this.inputValue === '<br />' || this.inputValue === '<p><br></p>') {
                    this.inputValue = '';
                }
                
                this.inputValue = event.target.innerHTML.trim()
            }
        }
    }
}

import 'alpinejs'