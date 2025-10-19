<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to DailyTimes Newsletter</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 10px;
        }
        .welcome-title {
            font-size: 24px;
            color: #1f2937;
            margin-bottom: 20px;
        }
        .content {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 30px;
        }
        .highlight {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }
        .benefits {
            background: #f3f4f6;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .benefits ul {
            margin: 0;
            padding-left: 20px;
        }
        .benefits li {
            margin-bottom: 8px;
            color: #374151;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #6b7280;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">DailyTimes</div>
            <h1 class="welcome-title">Welcome to Our Newsletter!</h1>
        </div>

        <div class="content">
            <p>Hello there!</p>
            
            <p>Thank you for subscribing to <strong>{{ $email }}</strong>! We're thrilled to have you join our community of informed readers.</p>

            <div class="highlight">
                <h3 style="margin: 0 0 10px 0;">🎉 You're All Set!</h3>
                <p style="margin: 0;">You'll now receive our latest news, insights, and exclusive content directly in your inbox.</p>
            </div>

            <div class="benefits">
                <h3 style="color: #1f2937; margin-top: 0;">What to expect:</h3>
                <ul>
                    <li>📰 Breaking news alerts and trending stories</li>
                    <li>📊 In-depth analysis and editorial insights</li>
                    <li>🎯 Curated content tailored to your interests</li>
                    <li>⚡ Weekly roundups of the most important stories</li>
                    <li>🔍 Exclusive interviews and behind-the-scenes content</li>
                </ul>
            </div>

            <p>We respect your inbox and promise to deliver only high-quality, relevant content. You can update your preferences or unsubscribe at any time.</p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/') }}" class="button">Visit DailyTimes</a>
            </div>
        </div>

        <div class="footer">
            <p><strong>DailyTimes</strong> - Your trusted source for news and insights</p>
            <p>This email was sent to {{ $email }} because you subscribed to our newsletter.</p>
            <p>© {{ date('Y') }} DailyTimes. All rights reserved.</p>
        </div>
    </div>
</body>
</html>