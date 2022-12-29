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
    @if (session('success'))
        <div class="alert alert-info">
            {{ session::get('success') }}
        </div>
    @endif

    <hr /><hr />

    <table class="table table-bordered border-primary">

        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">First</th>
              <th scope="col">Last</th>
              <th scope="col">Handle</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>mdo</td>
            </tr>

          </tbody>
    </table>



    <script src="{{ asset('codedassets/js/bootstrap.bundle.min.js') }}" ></script>

  </body>
</html>