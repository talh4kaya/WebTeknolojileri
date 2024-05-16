new Vue({
    el: '#app',
    data: {
        form: {
            name: '',
            email: '',
            message: '',
            gender: '',
            hobbies: []
        },
        errors: {}
    },
    methods: {
        validateForm() {
            this.errors = {};

            // Name validation
            if (!this.form.name) {
                this.errors.name = 'İsim alanı zorunludur.';
            } else if (this.form.name.length < 3) {
                this.errors.name = 'Ad en az 3 karakter olmalıdır.';
            }

            // Email validation
            if (!this.form.email) {
                this.errors.email = 'Eposta alanı zorunludur.';
            } else if (!this.isValidEmail(this.form.email)) {
                this.errors.email = 'Geçerli bir e-posta adresi girin.';
            }

            // Message validation
            if (!this.form.message) {
                this.errors.message = 'Mesaj alanı zorunludur.';
            } else if (this.form.message.length < 10) {
                this.errors.message = 'Mesaj en az 10 karakter olmalıdır.';
            }

            // Gender validation
            if (!this.form.gender) {
                this.errors.gender = 'Cinsiyet seçimi zorunludur.';
            }

            // If no errors, form is valid
            if (Object.keys(this.errors).length === 0) {
                alert('Form başarıyla gönderildi!');
                // Form submission logic goes here
            }
        },
        isValidEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()[\]\\.,;:\s@"]+\.)+[^<>()[\]\\.,;:\s@"]{2,})$/i;
            return re.test(email);
        }
    }
});
