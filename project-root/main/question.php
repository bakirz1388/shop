<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/logoBakiRZ.png">
    <title>BakiRZ | سوالات متداول</title>

    <style>
        /* ============================================
           FAQ PAGE - GAMING STYLE
           ============================================ */
        .faq-page {
            padding: var(--space-12) 0;
            min-height: 70vh;
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 var(--space-4);
        }

        .faq-title {
            text-align: center;
            font-size: var(--text-4xl);
            font-weight: var(--font-black);
            margin-bottom: var(--space-12);
            text-transform: uppercase;
            letter-spacing: 2px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary), var(--color-rgb-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .faq-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            margin: var(--space-3) auto 0;
            background: linear-gradient(90deg, var(--color-primary), var(--color-secondary), var(--color-rgb-purple));
            border-radius: var(--radius-full);
            animation: rgbSlide 3s ease-in-out infinite;
        }

        /* ============================================
           FAQ ITEM - GAMING ACCORDION
           ============================================ */
        .faq-item {
            margin-bottom: var(--space-4);
            border-radius: var(--radius-lg);
            background: var(--color-gaming-card);
            border: 1px solid var(--color-gaming-border);
            overflow: hidden;
            transition: var(--transition-base);
            position: relative;
        }

        .faq-item:hover {
            border-color: var(--color-secondary);
            box-shadow: 0 0 30px rgba(0, 229, 255, 0.05);
        }

        /* RGB Animated Border */
        .faq-item::before {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: inherit;
            padding: 1px;
            background: linear-gradient(90deg, 
                var(--color-rgb-red), 
                var(--color-rgb-cyan), 
                var(--color-rgb-purple), 
                var(--color-rgb-red)
            );
            background-size: 300% 100%;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: var(--transition-base);
            z-index: 0;
        }

        .faq-item:hover::before {
            opacity: 1;
            animation: rgbBorder 3s ease-in-out infinite;
        }

        @keyframes rgbBorder {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .faq-item>* {
            position: relative;
            z-index: 1;
        }

        /* ============================================
           QUESTION
           ============================================ */
        .faq-question {
            user-select: none;
            cursor: pointer;
            padding: var(--space-4) var(--space-5);
            padding-inline-end: var(--space-12);
            background: var(--color-neutral-900);
            color: var(--color-text-primary);
            font-weight: var(--font-bold);
            font-size: var(--text-base);
            transition: var(--transition-base);
            position: relative;
            border: none;
            width: 100%;
            text-align: right;
            font-family: inherit;
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        .faq-question:hover {
            background: var(--color-neutral-800);
            color: var(--color-white);
        }

        .faq-question .question-icon {
            flex-shrink: 0;
            font-size: var(--text-xl);
            transition: var(--transition-base);
        }

        .faq-question .question-text {
            flex: 1;
        }

        /* Arrow indicator */
        .faq-question .arrow {
            position: absolute;
            inset-inline-end: var(--space-4);
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-base);
            color: var(--color-text-muted);
        }

        .faq-question .arrow svg {
            width: 20px;
            height: 20px;
            transition: var(--transition-base);
            fill: none;
            stroke: currentColor;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .faq-item.open .faq-question .arrow svg {
            transform: rotate(180deg);
            color: var(--color-secondary);
        }

        .faq-item.open .faq-question {
            background: var(--color-neutral-800);
            color: var(--color-white);
        }

        .faq-item.open .faq-question .question-icon {
            transform: scale(1.1);
        }

        /* ============================================
           ANSWER
           ============================================ */
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.65, 0, 0.35, 1),
                        opacity 0.4s ease,
                        padding 0.4s ease;
            opacity: 0;
            padding: 0 var(--space-5);
            background: var(--color-gaming-darker);
        }

        .faq-answer.open {
            max-height: 300px;
            opacity: 1;
            padding: var(--space-5) var(--space-5) var(--space-6);
        }

        .faq-answer p {
            direction: rtl;
            color: var(--color-text-secondary);
            font-weight: var(--font-normal);
            line-height: 1.8;
            margin: 0;
            font-size: var(--text-base);
        }

        .faq-answer p::before {
            content: '▸ ';
            color: var(--color-secondary);
            font-weight: var(--font-bold);
        }

        /* ============================================
           RGB ANIMATED BAR - UNDER ANSWER
           ============================================ */
        .faq-rgb-bar {
            height: 3px;
            width: 0;
            background: linear-gradient(90deg, 
                var(--color-rgb-red), 
                var(--color-rgb-orange), 
                var(--color-rgb-cyan), 
                var(--color-rgb-purple), 
                var(--color-rgb-red)
            );
            background-size: 300% 100%;
            border-radius: var(--radius-full);
            transition: width 0.6s cubic-bezier(0.65, 0, 0.35, 1);
            position: relative;
            margin-top: var(--space-2);
        }

        .faq-item.open .faq-rgb-bar {
            width: 100%;
            animation: rgbSlide 2s ease-in-out infinite;
        }

        @keyframes rgbSlide {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Glow effect on bar */
        .faq-rgb-bar::after {
            content: '';
            position: absolute;
            inset: 0;
            filter: blur(8px);
            background: inherit;
            opacity: 0.5;
            border-radius: inherit;
        }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 768px) {
            .faq-title {
                font-size: var(--text-2xl);
            }
            
            .faq-question {
                font-size: var(--text-sm);
                padding: var(--space-3) var(--space-4);
                padding-inline-end: var(--space-10);
            }

            .faq-answer.open {
                padding: var(--space-3) var(--space-4) var(--space-4);
            }

            .faq-answer p {
                font-size: var(--text-sm);
            }
        }

        @media (max-width: 480px) {
            .faq-title {
                font-size: var(--text-xl);
            }
            
            .faq-question {
                font-size: var(--text-sm);
                padding: var(--space-3) var(--space-3);
                padding-inline-end: var(--space-8);
            }

            .faq-question .arrow {
                width: 20px;
                height: 20px;
                inset-inline-end: var(--space-2);
            }

            .faq-question .arrow svg {
                width: 16px;
                height: 16px;
            }
        }

        /* ============================================
           SCROLL REVEAL ANIMATION
           ============================================ */
        .faq-item {
            opacity: 0;
            transform: translateY(30px);
            animation: faqReveal 0.6s var(--ease-out) forwards;
        }

        .faq-item:nth-child(1) { animation-delay: 0.1s; }
        .faq-item:nth-child(2) { animation-delay: 0.2s; }
        .faq-item:nth-child(3) { animation-delay: 0.3s; }
        .faq-item:nth-child(4) { animation-delay: 0.4s; }
        .faq-item:nth-child(5) { animation-delay: 0.5s; }

        @keyframes faqReveal {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <?php include("../includes/header.php") ?>

    <main>
        <section class="faq-page">
            <div class="faq-container">
                <h1 class="faq-title">🎮 سوالات متداول</h1>

                <!-- FAQ Item 1 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="question-icon">🕹️</span>
                        <span class="question-text">چگونه ثبت نام کنیم؟</span>
                        <span class="arrow">
                            <svg viewBox="0 0 24 24">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>از صفحه ورود، روی لینک ثبت نام بزنید و اطلاعات حساب را وارد کنید.</p>
                        <div class="faq-rgb-bar"></div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="question-icon">🛒</span>
                        <span class="question-text">چگونه سفارش ثبت کنیم؟</span>
                        <span class="arrow">
                            <svg viewBox="0 0 24 24">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>محصول را به سبد خرید اضافه کنید و بعد از بررسی فاکتور، روی خرید نهایی بزنید.</p>
                        <div class="faq-rgb-bar"></div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="question-icon">⚠️</span>
                        <span class="question-text">اگر موجودی تمام شود چه می‌شود؟</span>
                        <span class="arrow">
                            <svg viewBox="0 0 24 24">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>سیستم هنگام خرید نهایی موجودی را دوباره بررسی می‌کند و اگر کالا تمام شده باشد ثبت سفارش انجام نمی‌شود.</p>
                        <div class="faq-rgb-bar"></div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="question-icon">📞</span>
                        <span class="question-text">چگونه با پشتیبانی تماس بگیریم؟</span>
                        <span class="arrow">
                            <svg viewBox="0 0 24 24">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>از صفحه تماس با ما می‌توانید با تلفن، ایمیل یا لینک واتساپ ارتباط بگیرید.</p>
                        <div class="faq-rgb-bar"></div>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="question-icon">🚀</span>
                        <span class="question-text">آیا امکان توسعه بیشتر سایت وجود دارد؟</span>
                        <span class="arrow">
                            <svg viewBox="0 0 24 24">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>بله. ساختار فعلی برای اضافه شدن جستجو، فیلتر، گزارش سفارش و پنل‌های کامل‌تر آماده‌تر شده است.</p>
                        <div class="faq-rgb-bar"></div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <?php include("../includes/footer.php") ?>

    <script>
        // ============================================
        // FAQ ACCORDION WITH RGB BAR ANIMATION
        // ============================================
        document.addEventListener('DOMContentLoaded', function() {
            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');

                question.addEventListener('click', function() {
                    const isOpen = item.classList.contains('open');

                    // Close all others
                    faqItems.forEach(other => {
                        if (other !== item && other.classList.contains('open')) {
                            other.classList.remove('open');
                            other.querySelector('.faq-answer').classList.remove('open');
                            other.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
                        }
                    });

                    // Toggle current
                    if (isOpen) {
                        item.classList.remove('open');
                        answer.classList.remove('open');
                        question.setAttribute('aria-expanded', 'false');
                    } else {
                        item.classList.add('open');
                        answer.classList.add('open');
                        question.setAttribute('aria-expanded', 'true');
                    }
                });

                // Keyboard support (Enter/Space)
                question.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        question.click();
                    }
                });
            });
        });
    </script>

    <script src="../assets/js/jquery.main.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>