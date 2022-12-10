<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <style>
        body {
            margin: 0;
            font-family:'Pretendard', sans-serif;
            color:#222;
            font-weight:normal;
            font-size: 1rem;
            line-height: 160%;
        }

        .policy-container {
            padding: 1.6rem;
        }

        .policy-content {
            width: 100%;
            white-space: normal;
            word-break: break-all;
        }

        .policy-content h1 {
            font-weight: 700;
            font-size: 1.6rem;
            padding: 0 0 1rem;
        }

        .policy-content dl {
            width:100%;
            padding: 0 0 0.8rem;
        }

        .policy-content dt {
            width: 100%;
            padding: 0 0 0.6rem;
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        .policy-content dd {
            width:100%;
            padding: 0;
            margin: 0;
            color: #555;
        }
    </style>
</head>


<body>
<!-- policy-container -->
<div class="policy-container">
    <!-- policy-content -->
    <div class="policy-content">
        <h1>{{ __('msg.PP') }}</h1>
        <dl>
            <dt>{{ __('msg.RYP') }}</dt>
            <dd>{{ __('msg.RYP1') }}</dd>
        </dl>
        <dl>
            <dt>{{ __('msg.DCI') }}</dt>
            <dd>{{ __('msg.DCI1') }}</dd>
        </dl>
        <dl>
            <dt>{{ __('msg.DSAC') }}</dt>
            <dd>{{ __('msg.DSAC1') }}<br>{{ __('msg.DSAC2') }}</dd>
        </dl>
        <dl>
            <dt>{{ __('msg.NOCTP') }}</dt>
            <dd>{{ __('msg.NOCTP1') }}</dd>
        </dl>
        <dl>
            <dt>{{ __('msg.SUPPORT') }}</dt>
            <dd>{{ __('msg.SUPPORT_EMAIL') }}</dd>
        </dl>
    </div>
    <!-- // policy-content -->
</div>
<!-- // policy-container -->
</body>
</html>
