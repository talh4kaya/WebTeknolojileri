document.addEventListener("DOMContentLoaded", function () {
    new Vue({
        el: '#app',
        data: {
            form: {
                name: '',
                email: '',
                message: '',
                gender: ''
            },
            errors: {}
        },
        methods: {
            submitForm() {
                this.errors = {}; // Reset errors object
                if (!this.form.name) {
                    this.errors.name = 'Lütfen adınızı girin.';
                }
                if (!this.form.email) {
                    this.errors.email = 'Lütfen e-posta adresinizi girin.';
                } else if (!this.validEmail(this.form.email)) {
                    this.errors.email = 'Geçerli bir e-posta adresi girin.';
                }
                if (!this.form.message || this.form.message.length < 10) {
                    this.errors.message = 'Mesaj en az 10 karakter olmalıdır.';
                }
                if (!this.form.gender) {
                    this.errors.gender = 'Lütfen cinsiyetinizi seçin.';
                }
                // If there are no errors, form submission can proceed
                if (Object.keys(this.errors).length === 0) {
                    // Submit the form
                    document.getElementById('myForm').submit();
                }
            },
            validEmail(email) {
                // Very basic email validation
                const re = /\S+@\S+\.\S+/;
                return re.test(email);
            },
            resetForm() {
                this.form = {
                    name: '',
                    email: '',
                    message: '',
                    gender: ''
                };
                this.errors = {};
            }
        }
    });
});
