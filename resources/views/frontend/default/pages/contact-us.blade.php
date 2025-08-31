
@extends('frontend.default.layouts.master')

@section('title')
    Contact Us
@endsection

@section('contents')
<style>
    body { background: #fff; }
    .contact-header-bg {
        background: url('{{ asset("frontend/pashupatinath.jpg") }}') no-repeat center center;
        background-size: cover;
        height: 340px;
        position: relative;
        width: 100%;
    }
    .contact-title {
        position: absolute;
        left: 0; right: 0; top: 40%;
        transform: translateY(-40%);
        text-align: center;
        color: #006633;
        font-size: 2.5rem;
        font-weight: bold;
        letter-spacing: 2px;
    }
    .contact-main-box {
        background: #f2f2f2ff;
        border-radius: 18px;
        margin: -80px auto 0 auto;
        max-width: 900px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        padding: 40px 30px 30px 30px;
        display: flex;
        gap: 0;
        position: relative;
        z-index: 2;
    }
    .contact-info-box {
        width: 35%;
        padding-right: 30px;
        display: flex;
        flex-direction: column;
        gap: 30px;
        justify-content: center;
    }
    .contact-form-box {
        width: 65%;
        border-left: 1px solid #aaa;
        padding-left: 30px;
    }
    .contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 18px;
    }
    .contact-info-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #006633;
    }
    .contact-info-label {
        font-weight: bold;
        color: #006633;
        font-size: 1.1rem;
        margin-bottom: 2px;
    }
    .contact-info-value {
        color: #222;
        font-size: 1rem;
        margin-bottom: 2px;
    }
    .contact-form-title {
        color: #006633;
        font-weight: bold;
        font-size: 1.3rem;
        margin-bottom: 18px;
        letter-spacing: 1px;
    }
    .contact-form-row {
        display: flex;
        gap: 16px;
        margin-bottom: 14px;
    }
    .contact-form-row > * {
        flex: 1;
    }
    .contact-form-box input,
    .contact-form-box textarea {
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 3px;
        padding: 10px 12px;
        font-size: 1rem;
        margin-bottom: 0;
        background: #fff;
        color: #222;
    }
    .contact-form-box textarea {
        resize: vertical;
        min-height: 60px;
        max-height: 120px;
    }
    .contact-form-box input:focus,
    .contact-form-box textarea:focus {
        outline: none;
        border-color: #006633;
    }
    .contact-form-captcha {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }
    .contact-form-send-btn {
        background: #006633;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 32px;
        font-size: 1.1rem;
        font-weight: bold;
        letter-spacing: 1px;
        cursor: pointer;
        transition: background 0.2s;
    }
    .contact-form-send-btn:hover {
        background: #145c32;
    }
    @media (max-width: 900px) {
        .contact-main-box { flex-direction: column; padding: 30px 10px; }
        .contact-info-box, .contact-form-box { width: 100%; border: none; padding: 0; }
        .contact-form-box { margin-top: 30px; }
    }
</style>

<div class="contact-header-bg">
    <div class="contact-title">CONTACT US</div>
</div>

<div class="contact-main-box mb-20">
    <div class="contact-info-box">
        <div class="contact-info-item">
            <span class="contact-info-icon"><i class="fas fa-envelope"></i></span>
<div>
  <div class="contact-info-label">Email</div>
 <div class="contact-info-value" style="color: #333;">
  <a href="mailto:uliaamart@gmail.com" class="hover:underline" style="color: #333;">uliaamart@gmail.com</a><br>
  <a href="mailto:uliamart@support.com" class="hover:underline" style="color: #333;">uliamart@support.com</a>
</div>


</div>

        </div>
        <div class="contact-info-item">
            <span class="contact-info-icon"><i class="fas fa-clock"></i></span>
            <div>
                <div class="contact-info-label">Office Time</div>
                <div class="contact-info-value">Sunday to Friday<br>(10am to 5pm)</div>
            </div>
        </div>
        <div class="contact-info-item">
            <span class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></span>
            <div>
                <div class="contact-info-label">Address</div>
                <div class="contact-info-value">Tokha Mun-03,<br>Kathmandu, Bagmati Province,<br>Nepal</div>
            </div>
        </div>
    </div>
    <div class="contact-form-box">
        <div class="contact-form-title">SEND US MESSAGE</div>
        <form action="{{ route('contactUs.store') }}" method="post">
            @csrf
            <div class="contact-form-row">
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
            </div>
            <div class="contact-form-row">
                <input type="text" name="company_name" placeholder="Company Name">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="contact-form-row">
                <input type="text" name="phone" placeholder="Phone">
                <input type="text" name="mobile" placeholder="Mobile">
            </div>
            <div class="contact-form-row">
                <select name="support_for" style="width: 100%; border: 1px solid #ccc; border-radius: 3px; padding: 10px 12px; font-size: 1rem; margin-bottom: 0; background: #fff; color: #222;">
                    <option value="delivery_problem">Delivery Problem</option>
                    <option value="customer_service">Customer Service</option>
                    <option value="other_service" selected>Others Service</option>
                </select>
            </div>
            <div class="contact-form-row">
                <textarea name="address" placeholder="Address"></textarea>
            </div>
            <div class="contact-form-row">
                <textarea name="message" placeholder="Message" required></textarea>
            </div>
            <div class="contact-form-captcha">
                <span id="captcha-question">8 + 3 =</span>
                <input type="text" name="captcha" id="captcha-answer" style="width: 60px;">
            </div>
            <button type="submit" class="contact-form-send-btn" id="contact-submit-btn">SEND</button>
        </form>
    </div>
</div>

<script>
    // Dynamic captcha generation
    let num1 = Math.floor(Math.random() * 10) + 1;
    let num2 = Math.floor(Math.random() * 10) + 1;
    let captchaSum = num1 + num2;
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('captcha-question').textContent = num1 + ' + ' + num2 + ' =';
        const form = document.querySelector('.contact-form-box form');
        const submitBtn = document.getElementById('contact-submit-btn');
        form.addEventListener('submit', function(e) {
            const answer = document.getElementById('captcha-answer').value;
            if (parseInt(answer) !== captchaSum) {
                e.preventDefault();
                document.getElementById('captcha-answer').style.borderColor = '#dc3545';
                if (!document.getElementById('captcha-error')) {
                    const errorMsg = document.createElement('span');
                    errorMsg.id = 'captcha-error';
                    errorMsg.textContent = 'Incorrect answer. Please try again.';
                    errorMsg.style.color = '#dc3545';
                    errorMsg.style.fontSize = '12px';
                    errorMsg.style.marginLeft = '10px';
                    document.getElementById('captcha-question').parentNode.appendChild(errorMsg);
                }
            } else {
                // Captcha is correct, allow form submission
                document.getElementById('captcha-answer').style.borderColor = '#006633';
                const errorMsg = document.getElementById('captcha-error');
                if (errorMsg) errorMsg.remove();
                // Form will submit normally
            }
        });
    });
</script>
@endsection
