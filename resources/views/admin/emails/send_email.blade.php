<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $heading ?? $subjectText ?? config('app.name') }}</title>

    <style>
        body {
            background-color: #f6f9fc;
            color: #333333;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            width: 100%;
            padding: 32px 16px;
        }

        .email-inner {
            max-width: 680px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
        }

        .email-header {
            padding: 20px 28px;
            background: linear-gradient(90deg,#1e88e5,#00bcd4);
            color: #fff;
        }

        .brand {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .preheader {
            display:none !important;
            visibility:hidden;
            opacity:0;
            height:0;
            width:0;
        }

        .email-body {
            padding: 26px 28px;
            color: #444;
            line-height: 1.6;
            font-size: 15px;
        }

        .email-heading {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 8px;
            color: #111;
        }

        .email-content {
            margin: 14px 0;
        }

        .cta {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 700;
            background: #2b9af3;
            color: white;
        }

        .muted {
            color: #6b7280;
            font-size: 13px;
        }

        .divider {
            height: 1px;
            background: #eef2f7;
            margin: 18px 0;
        }

        .footer {
            padding: 18px 28px;
            font-size: 13px;
            color: #7a7f85;
            background: #fafafa;
        }

        .small {
            font-size: 13px;
            color: #9aa0a6;
        }

        @media (max-width:600px) {
            .email-inner {
                margin: 0 12px;
            }
            .email-header,
            .email-body,
            .footer {
                padding-left: 16px;
                padding-right: 16px;
            }
        }
    </style>
</head>

<body>
    {{-- Preheader (hidden) --}}
    <span class="preheader">{{ $preheader ?? '' }}</span>

    <div class="email-wrapper">
        <div class="email-inner">

            {{-- Header --}}
            <div class="email-header">
                <div class="brand">{{ config('app.name') }}</div>
            </div>

            {{-- Body --}}
            <div class="email-body">

                @if(!empty($heading))
                    <h1 class="email-heading">{{ $heading }}</h1>
                @endif

                <div class="email-content">
                    {{-- Allow HTML + convert line breaks --}}
                    {!! nl2br($bodyText) !!}
                </div>

                {{-- CTA Button --}}
                @if(!empty($actionText) && !empty($actionUrl))
                    <div style="margin: 18px 0;">
                        <a href="{{ $actionUrl }}" class="cta" target="_blank" rel="noopener noreferrer">
                            {{ $actionText }}
                        </a>
                    </div>
                @endif

                <div class="divider"></div>

                {{-- Generic Line --}}
                <p class="muted">
                    If you did not expect this email, please ignore it or contact our support team.
                </p>

                {{-- Footer Text --}}
                <p class="small" style="margin-top: 6px;">
                    {{ $footer }}
                </p>
            </div>

            {{-- Bottom Footer --}}
            <div class="footer">
                <div class="small">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</div>
            </div>

        </div>
    </div>
</body>
</html>
