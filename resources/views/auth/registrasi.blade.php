<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page | Register</title>
</head>

<style>
    /* Modern SaaS Login Form - Complete & Self-Contained */

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        background: #fafbfc;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        line-height: 1.5;
    }

    .login-container {
        width: 100%;
        max-width: 400px;
    }

    .login-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 48px 40px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02), 0 8px 16px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .login-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .logo-wrapper {
        margin-bottom: 20px;
        display: flex;
        justify-content: center;

        width: 40px;
        height: 40px;
        background-color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        box-shadow: 0 4px 12px rgba(99, 91, 255, 0.2);
    }

    .login-header h1 {
        color: #1a1f36;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 8px;
        letter-spacing: -0.02em;
    }

    .login-header p {
        color: #8792a2;
        font-size: 14px;
        font-weight: 400;
    }

    /* Input Groups with Floating Labels */
    .input-group {
        position: relative;
        margin-bottom: 24px;
    }

    .input-group input {
        width: 100%;
        background: #ffffff;
        border: 1px solid #e3e8ee;
        border-radius: 6px;
        padding: 16px 14px 8px 14px;
        color: #1a1f36;
        font-size: 16px;
        font-weight: 400;
        outline: none;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .input-group input:focus {
        border-color: #635BFF;
    }

    .input-group input::placeholder {
        color: transparent;
    }

    .input-group label {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #8792a2;
        font-size: 16px;
        font-weight: 400;
        pointer-events: none;
        transition: all 0.2s ease;
        background: #ffffff;
        padding: 0 2px;
    }

    .input-group input:focus+label,
    .input-group input:not(:placeholder-shown)+label {
        top: 0;
        font-size: 12px;
        font-weight: 500;
        color: #635BFF;
        transform: translateY(-50%);
    }

    .input-group input:not(:focus):not(:placeholder-shown)+label {
        color: #6b7385;
    }

    /* Custom Border Animation */
    .input-border {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: #635BFF;
        transition: width 0.3s ease;
    }

    .input-group input:focus~.input-border {
        width: 100%;
    }

    /* Password Toggle */
    .input-group:has(.password-toggle) input {
        padding-right: 42px;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #8792a2;
        padding: 6px;
        border-radius: 4px;
        transition: color 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .password-toggle:hover {
        color: #635BFF;
    }

    /* Form Options */
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 14px;
        color: #6b7385;
        font-weight: 500;
    }

    .checkbox-container input[type="checkbox"] {
        display: none;
    }

    .checkmark {
        width: 18px;
        height: 18px;
        border: 1.5px solid #d1d9e0;
        border-radius: 4px;
        margin-right: 10px;
        position: relative;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        color: transparent;
    }

    .checkbox-container input[type="checkbox"]:checked+.checkmark {
        background: #635BFF;
        border-color: #635BFF;
        color: white;
    }

    .forgot-link {
        color: #635BFF;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .forgot-link:hover {
        color: #4c44d4;
    }

    /* Submit Button */
    .submit-btn {
        width: 100%;
        background: #635BFF;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        padding: 14px 20px;
        margin-top: 42px;
        cursor: pointer;
        font-family: inherit;
        font-size: 16px;
        font-weight: 500;
        position: relative;
        margin-bottom: 24px;
        transition: all 0.2s ease;
        overflow: hidden;
        min-height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .submit-btn:hover {
        background: #4c44d4;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(99, 91, 255, 0.4);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .submit-btn:disabled {
        background: #a2a7b5;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .btn-text {
        transition: opacity 0.2s ease;
    }

    .btn-loader {
        position: absolute;
        opacity: 0;
        transition: opacity 0.2s ease;
        color: #ffffff;
    }

    .submit-btn.loading .btn-text {
        opacity: 0;
    }

    .submit-btn.loading .btn-loader {
        opacity: 1;
    }

    /* Divider */
    .divider {
        text-align: center;
        margin: 24px 0;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e3e8ee;
    }

    .divider span {
        background: #ffffff;
        color: #8792a2;
        padding: 0 16px;
        font-size: 13px;
        font-weight: 500;
        position: relative;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Social Buttons */
    .social-buttons {
        display: flex;
        gap: 12px;
        margin-bottom: 24px;
    }

    .social-btn {
        flex: 1;
        background: #ffffff;
        color: #6b7385;
        border: 1px solid #e3e8ee;
        border-radius: 6px;
        padding: 12px 16px;
        cursor: pointer;
        font-family: inherit;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s ease;
        min-height: 44px;
    }

    .social-btn:hover {
        border-color: #d1d9e0;
        background: #f8f9fa;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .social-btn:active {
        transform: translateY(0);
    }

    /* Signup Link */
    .signup-link {
        text-align: center;
        font-size: 14px;
        color: #8792a2;
    }

    .signup-link a {
        color: #635BFF;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .signup-link a:hover {
        color: #4c44d4;
        text-decoration: underline;
    }

    /* Error States */
    .error-message {
        color: #f56565;
        font-size: 12px;
        font-weight: 500;
        margin-top: 6px;
        opacity: 0;
        transform: translateY(-4px);
        transition: all 0.2s ease;

        position: absolute;
        bottom: -18px;
        left: 0;
    }

    .error-message.show {
        opacity: 1;
        transform: translateY(0);
    }

    .input-group.error input {
        border-color: #f56565;
        background: #fef5f5;
    }

    .input-group.error input:focus {
        border-color: #f56565;
    }

    .input-group.error label {
        color: #f56565;
    }

    .input-group.error .input-border {
        background: #f56565;
    }

    /* Success Message */
    .success-message {
        display: none;
        text-align: center;
        padding: 32px 20px;
        opacity: 0;
        transform: translateY(16px);
        transition: all 0.3s ease;
    }

    .success-message.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .success-icon {
        margin: 0 auto 16px;
        animation: successPop 0.5s ease-out;
    }

    @keyframes successPop {
        0% {
            transform: scale(0);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    .success-message h3 {
        color: #1a1f36;
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .success-message p {
        color: #8792a2;
        font-size: 14px;
    }

    /* Mobile Responsive */
    @media (max-width: 480px) {
        body {
            padding: 16px;
        }

        .login-card {
            padding: 36px 28px;
            border-radius: 8px;
        }

        .login-header h1 {
            font-size: 1.375rem;
        }

        .form-options {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .social-buttons {
            flex-direction: column;
        }
    }
</style>


<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-wrapper">

                    <img src="{{ asset('images/car-rental-transportation-rent-automobile-svgrepo-com.svg') }}"
                        alt="rent_car" width="22" height="22" fill="#635BFF">
                </div>
                <h1>Buat Akun Sewa Mobil😊</h1>
                <p>Cuma beberapa detik buat akun</p>
            </div>

            <form class="login-form" id="loginForm" action="{{ route('registrasi.aksi') }}" method="POST">

                @csrf

                <div class="input-group">
                    <input type="text" id="name" name="name" required autocomplete="name" placeholder=" ">
                    <label for="name">Nama </label>
                    <span class="input-border"></span>
                    <span class="error-message @error('name') show @enderror" id="nameError">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>

                </div>

                <div class="input-group">
                    <input type="email" id="email" name="email" required autocomplete="email" placeholder=""
                        value="{{ old('email') }}">
                    <label for="email">Email address</label>
                    <span class="input-border"></span>

                    <span class="error-message @error('email') show @enderror" id="emailError">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>

                </div>

                <div class="input-group">
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                        placeholder=" ">
                    <label for="password">Password</label>
                    <button type="button" class="password-toggle" id="passwordToggle"
                        aria-label="Toggle password visibility">
                        <svg class="eye-icon" width="22" height="22" viewBox="0 0 16 16" fill="none">
                            <path
                                d="M8 3C4.5 3 1.6 5.6 1 8c.6 2.4 3.5 5 7 5s6.4-2.6 7-5c-.6-2.4-3.5-5-7-5zm0 8.5A3.5 3.5 0 118 4.5a3.5 3.5 0 010 7zm0-5.5a2 2 0 100 4 2 2 0 000-4z"
                                fill="currentColor" />
                        </svg>
                    </button>
                    <span class="input-border"></span>
                    <span class="error-message" id="passwordError"></span>
                    @error('password')
                        <span class="error-message show">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">
                    <span class="btn-text">Daftar Sekarang</span>
                    <div class="btn-loader">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="2" opacity="0.25" />
                            <path d="M16 9a7 7 0 01-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <animateTransform attributeName="transform" type="rotate" dur="1s"
                                    values="0 9 9;360 9 9" repeatCount="indefinite" />
                            </path>
                        </svg>
                    </div>
                </button>
            </form>

            <div class="signup-link">
                <span>Sudah Punya Akun? </span>
                <a href="{{ route('login') }}">Click Sini</a>
            </div>

            <div class="success-message" id="successMessage">
                <div class="success-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="12" fill="#635BFF" />
                        <path d="M8 12l3 3 5-5" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <h3>Welcome back!</h3>
                <p>Redirecting to your dashboard...</p>
            </div>
        </div>
    </div>

    <script>
        // Modern SaaS Login Form JavaScript
        class ModernSaaSLoginForm {
            constructor() {
                this.form = document.getElementById('loginForm');
                this.nameInput = document.getElementById('name')
                this.emailInput = document.getElementById('email');
                this.passwordInput = document.getElementById('password');
                this.passwordToggle = document.getElementById('passwordToggle');
                this.submitButton = this.form.querySelector('.submit-btn');
                this.successMessage = document.getElementById('successMessage');
                this.socialButtons = document.querySelectorAll('.social-btn');

                this.init();
            }

            init() {
                this.nameInput.addEventListener('blur', () => this.validateName());
                this.nameInput.addEventListener('input', () => this.clearError('name'));
                this.bindEvents();
                this.setupPasswordToggle();
                this.setupSocialButtons();
            }

            bindEvents() {
                this.form.addEventListener('submit', (e) => this.handleSubmit(e));
                this.emailInput.addEventListener('blur', () => this.validateEmail());
                this.passwordInput.addEventListener('blur', () => this.validatePassword());
                this.emailInput.addEventListener('input', () => this.clearError('email'));
                this.passwordInput.addEventListener('input', () => this.clearError('password'));
            }

            setupPasswordToggle() {
                this.passwordToggle.addEventListener('click', () => {
                    const type = this.passwordInput.type === 'password' ? 'text' : 'password';
                    this.passwordInput.type = type;

                    // Simple visual feedback
                    this.passwordToggle.style.color = type === 'text' ? '#635BFF' : '#8792a2';
                });
            }

            setupSocialButtons() {
                this.socialButtons.forEach(button => {
                    button.addEventListener('click', (e) => {
                        const provider = button.textContent.trim();
                        this.handleSocialLogin(provider, button);
                    });
                });
            }

            // ======== Validasi Nama Email dan Password ======== 
            validateName() {
                const name = this.nameInput.value.trim();

                if (!name) {
                    this.showError('name', 'Nama diperlukan');
                    return false;
                }

                if (name.length < 3) {
                    this.showError('name', 'Nama harus terdiri minimal 3 karakter.');
                    return false;
                }

                this.clearError('name');
                return true;
            }


            validateEmail() {
                const email = this.emailInput.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!email) {
                    this.showError('email', 'Email diperlukan');
                    return false;
                }

                if (!emailRegex.test(email)) {
                    this.showError('email', 'Masukkan Email yang valid.');
                    return false;
                }

                this.clearError('email');
                return true;
            }

            validatePassword() {
                const password = this.passwordInput.value;

                if (!password) {
                    this.showError('password', 'Kata sandi diperlukan');
                    return false;
                }

                if (password.length < 6) {
                    this.showError('password', 'Kata sandi harus terdiri minimal 6 karakter.');
                    return false;
                }

                this.clearError('password');
                return true;
            }

            showError(field, message) {
                const inputElement = document.getElementById(field);
                if (!inputElement) {
                    console.error(`element dengan id ${field} tidak ditemukan`);
                    return;
                }

                const inputGroup = document.getElementById(field).closest('.input-group');
                const errorElement = document.getElementById(`${field}Error`);

                inputGroup.classList.add('error');
                errorElement.textContent = message;
                errorElement.classList.add('show');
            }

            clearError(field) {
                const inputGroup = document.getElementById(field).closest('.input-group');
                const errorElement = document.getElementById(`${field}Error`);

                inputGroup.classList.remove('error');
                errorElement.classList.remove('show');
                setTimeout(() => {
                    errorElement.textContent = '';
                }, 200);
            }

            async handleSubmit(e) {

                const isNameValid = this.validateName();
                const isEmailValid = this.validateEmail();
                const isPasswordValid = this.validatePassword();

                if (!isEmailValid || !isPasswordValid || !isNameValid) {
                    e.preventDefault();
                    return;
                }
                this.setLoading(true);

                // try {
                //     // Show success
                //     this.showSuccess();
                // } catch (error) {
                //     this.showError('password', 'Registrasi Tidak Berhasil');
                // } finally {
                //     this.setLoading(false);
                // }
            }

            async handleSocialLogin(provider, button) {
                console.log(`Signing in with ${provider}...`);

                // Simple loading state
                const originalHTML = button.innerHTML;
                button.style.pointerEvents = 'none';
                button.style.opacity = '0.7';
                button.innerHTML = `
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <circle cx="7" cy="7" r="5.5" stroke="currentColor" stroke-width="1.5" opacity="0.25"/>
                <path d="M12.5 7a5.5 5.5 0 01-5.5 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                    <animateTransform attributeName="transform" type="rotate" dur="1s" values="0 7 7;360 7 7" repeatCount="indefinite"/>
                </path>
            </svg>
            Connecting...
        `;

                try {
                    await new Promise(resolve => setTimeout(resolve, 1500));
                    console.log(`Redirecting to ${provider} authentication...`);
                    // window.location.href = `/auth/${provider.toLowerCase()}`;
                } catch (error) {
                    console.error(`${provider} sign in failed: ${error.message}`);
                } finally {
                    button.style.pointerEvents = 'auto';
                    button.style.opacity = '1';
                    button.innerHTML = originalHTML;
                }
            }

            setLoading(loading) {
                this.submitButton.classList.toggle('loading', loading);
                this.submitButton.disabled = loading;

                // Disable social buttons during loading
                this.socialButtons.forEach(button => {
                    button.style.pointerEvents = loading ? 'none' : 'auto';
                    button.style.opacity = loading ? '0.6' : '1';
                });
            }

            showSuccess() {
                // Hide form with smooth transition
                this.form.style.transform = 'scale(0.95)';
                this.form.style.opacity = '0';

                setTimeout(() => {
                    this.form.style.display = 'none';
                    document.querySelector('.social-buttons').style.display = 'none';
                    document.querySelector('.signup-link').style.display = 'none';
                    document.querySelector('.divider').style.display = 'none';

                    // Show success message
                    this.successMessage.classList.add('show');

                }, 300);

                // Redirect after success display
                setTimeout(() => {
                    console.log('Redirecting to dashboard...');
                    // window.location.href = '/dashboard';
                }, 2500);
            }
        }

        // Initialize the form when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new ModernSaaSLoginForm();
        });
    </script>
</body>

</html>