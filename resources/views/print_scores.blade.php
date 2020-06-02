<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Assessment Result | {{ config('app.name') }}</title>
    </head>

    <body>
        <div align="center" style="width: 700px; margin: 0 auto;">
            {{ Html::image('images/logo-new.jpg', 'Halogen Logo', ['width' => 120]) }}<br />
            <h2>Assessment Result</h2>
        </div>
        <div style="width: 700px; margin: 0 auto;">
            <table border="2" width="100%" cellspacing="0" cellpadding="4">
                <tr>
                    <td width="30%">Assessment</td>
                    <td><strong>{{ $assessment->title }}</strong></td>
                </tr>
                <tr>
                    <td>Organization</td>
                    <td><strong>{{ $responder->organization_name }}</strong></td>
                </tr>
                <tr>
                    <td>Reviewer</td>
                    <td><strong>{{ $responder->reviewer_name }}</strong></td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td><strong>{{ $responder->email }}</strong></td>
                </tr>
                <tr>
                    <td>Total Score</td>
                    <td><strong>{{ App\AssResponse::where('responder_id', $responder->id)->sum('option_score') }} out of {{ App\AssResponse::where('responder_id', $responder->id)->sum('item_weight') }}</strong></td>
                </tr>
            </table>
        </div>
        @foreach (App\AssCategory::where('active', true)->orderBy('order_number')->get() as $category)
        <div style="width: 700px; margin: 0 auto;">
            <strong>{{ $category->description }} (Category Score: {{ App\AssResponse::whereIn('item_id', App\AssItem::where('category_id', $category->id)->pluck('id')->toArray())->where('responder_id', $responder->id)->sum('option_score') }} out of {{ App\AssResponse::whereIn('item_id', App\AssItem::where('category_id', $category->id)->pluck('id')->toArray())->where('responder_id', $responder->id)->sum('item_weight') }})</strong>
        </div>
        <div style="width: 700px; margin: 0 auto;">
            @foreach (App\AssItem::where('category_id', $category->id)->where('active', true)->orderBy('order_number')->get() as $item)
            <table border="2" width="100%" cellspacing="0" cellpadding="4">
                <tr>
                    <td width="60%">{{ $item->description }}</td>
                    <td width="20%">{{ App\AssResponse::where('item_id', $item->id)->where('responder_id', $responder->id)->first()->option_description }}</td>
                    <td width="20%" align="right">{{ App\AssResponse::where('item_id', $item->id)->where('responder_id', $responder->id)->first()->option_score }}</td>
                </tr>
            </table>
            @endforeach
        </div>
        @endforeach
    </body>
</html>
