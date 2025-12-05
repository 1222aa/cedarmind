<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', serif;
            background: #f5f5f5;
        }

        .certificate {
            width: 8.5in;
            height: 11in;
            margin: 0 auto;
            background: white;
            padding: 60px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .certificate::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 10px;
            background: linear-gradient(90deg, #3A6EA5, #6FA8DC, #1F4B7A);
        }

        .certificate::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 10px;
            background: linear-gradient(90deg, #3A6EA5, #6FA8DC, #1F4B7A);
        }

        .border-frame {
            border: 3px solid #3A6EA5;
            padding: 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .header {
            margin-bottom: 40px;
        }

        .logo {
            font-size: 36px;
            color: #3A6EA5;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .tagline {
            font-size: 14px;
            color: #666;
            font-style: italic;
        }

        .title {
            font-size: 48px;
            color: #3A6EA5;
            font-weight: bold;
            margin: 30px 0;
            letter-spacing: 3px;
        }

        .subtitle {
            font-size: 16px;
            color: #666;
            margin-bottom: 40px;
        }

        .recipient {
            font-size: 24px;
            color: #1F4B7A;
            font-weight: bold;
            margin: 30px 0;
            text-decoration: underline;
            text-decoration-style: dotted;
        }

        .course-section {
            margin: 40px 0;
            font-size: 14px;
            color: #333;
        }

        .course-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .course-title {
            font-size: 22px;
            color: #3A6EA5;
            font-weight: bold;
            margin: 10px 0;
        }

        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            font-size: 12px;
            color: #666;
        }

        .signature-line {
            text-align: center;
            border-top: 1px solid #333;
            padding-top: 5px;
            min-width: 150px;
        }

        .cert-number {
            font-size: 11px;
            color: #999;
            margin-top: 10px;
            letter-spacing: 1px;
        }

        .date-section {
            text-align: center;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 120px;
            color: rgba(58, 110, 165, 0.05);
            font-weight: bold;
            white-space: nowrap;
            pointer-events: none;
            z-index: 0;
        }

        .content {
            position: relative;
            z-index: 1;
        }

        .achievement-badge {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #3A6EA5, #6FA8DC);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 40px;
            box-shadow: 0 4px 15px rgba(58, 110, 165, 0.3);
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="watermark">CedarMind</div>

        <div class="border-frame">
            <div class="content">
                <div class="achievement-badge">
                    ✓
                </div>

                <div class="header">
                    <div class="logo">CedarMind</div>
                    <div class="tagline">Professional Learning Platform</div>
                </div>

                <div class="title">Certificate of Completion</div>

                <div class="subtitle">This certificate is proudly presented to</div>

                <div class="recipient">{{ $user_name }}</div>

                <div class="subtitle">For successfully completing the course</div>

                <div class="course-section">
                    <div class="course-label">Course Completed</div>
                    <div class="course-title">{{ $course_title }}</div>
                </div>

                <div class="footer">
                    <div class="date-section">
                        <div style="font-size: 12px; color: #666;">Date of Issue</div>
                        <div style="font-size: 14px; font-weight: bold; margin-top: 3px;">{{ $earned_date }}</div>
                    </div>

                    <div class="signature-line">
                        <div style="font-size: 12px; margin-bottom: 10px;">Authorized Signature</div>
                        <div style="height: 30px; border-top: 1px solid #333; margin-top: 5px;"></div>
                    </div>
                </div>

                <div class="cert-number">Certificate No. {{ $certificate_number }}</div>
            </div>
        </div>
    </div>
</body>
</html>
