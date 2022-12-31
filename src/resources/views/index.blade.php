<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@section('title', 'CODEDROI DEMO') @yield('title')</title>
    <link href="{{ asset('codedassets/css/bootstrap.min.css') }}" rel="stylesheet">
  </head>
  <body>
  <br /><br />
    <h3>
        <label="SELECT PLAN">SELECT PLAN</label>
    </h3>

  <div class="alert alert-success">
    If You have invested successfully, go ahead and enable crun job to expirience live trading,
                    if you are on localhost via command line, type: php artisan schedule:work. If you are on shared
                    hosting, login to cpanel and set a crun job with the correct path pointing to laravel Artisan file.</p>
                    <blockquote style="color:grey;">
                        /usr/local/bin/php /home/cpanel-username/public_html/artisan schedule:run >> /dev/null 2>&1
                    </blockquote>

  </div>
  @if (Session::has('success'))
  <div class="alert alert-success">{{ Session::get('success') }}</div>
  @elseif(Session::has('error'))
  <div class="alert alert-danger">{{ Session::get('error') }}</div>
  @endif


    <div class="container">
    <form method="POST" action="/submitplan">
        @csrf()

    <select class="form-select" name="plan" aria-label="Default select example">
        @forelse ($allplans as $plan)

        <option required value="{{$plan->id}}">{{$plan->bundle}} &nbsp; {{config('codedroi.roi_currency').number_format($plan->minimium,2)}} -  {{config('codedroi.roi_currency').number_format($plan->maximium,2)}}</option>

        @empty
            No plan found
        @endforelse


      </select>
      <br />

      <div class="input-group mb-3">
        <span class="input-group-text">$</span>
        <input required type="number" name="amount" class="form-control" aria-label="Amount (to the nearest dollar)">
        <span class="input-group-text">.00</span>
      </div><br />

      <button type="submit" class="btn btn-sm btn-success">INVEST NOW</button>
    </form>
    </div>

    </p>


    <hr /><hr />

    <table class="table table-bordered border-primary">

        <thead>
            <tr>
              <th scope="col">AMOUNT</th>
              <th scope="col">PLAN NAME</th>
              <th scope="col">EARNED</th>
              <th scope="col">DATE INVESTED</th>
               <th scope="col">END DATE</th>
                <th scope="col">EXPECTED ROI</th>
                 <th scope="col">NEXT PROFIT</th>
                <th scope="col">TIMES TRADED</th>
            </tr>
          </thead>
          <tbody>
          @forelse($invested as $earning)
            <tr>
              <th scope="row">{{ config('codedroi.roi_currency').number_format($earning->amount_invested,2) }}</th>
              <td>{{$earning->plan_name}}</td>
              <td>{{config('codedroi.roi_currency').number_format($earning->earned_amount,2)}}</td>
                 <td>{{date("jS M Y h:i:s a", strtotime($earning->date_invested))}}</td>
              <td>{{date("jS M Y h:i:s a", strtotime($earning->end_date))}}</td>
              <td>{{config('codedroi.roi_currency').number_format($earning->expected_return,2)}}</td>
              <td>{{date("jS M  Y h:i:s a", strtotime($earning->nextprofit_date))}}</td>
                      <td>{{$earning->counter > 1 ? $earning->counter.'times' : $earning->counter.'time'}}</td>
            </tr>
          @empty
            no earnings found
          @endforelse


          </tbody>
    </table>


  </body>
</html>
