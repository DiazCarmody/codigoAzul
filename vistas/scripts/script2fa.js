document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.code-inputs-2fa input');

    for (let i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('input', function() {
            if (this.value.length === this.maxLength) {
                if (i !== inputs.length - 1) {
                    inputs[i + 1].focus();
                }
            }
        });

        inputs[i].addEventListener('keydown', function(event) {
            if (event.key === 'Backspace' && this.value.length === 0) {
                if (i !== 0) {
                    inputs[i - 1].focus();
                }
            }
        });
    }
});