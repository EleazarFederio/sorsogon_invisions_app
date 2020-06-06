@extends('layouts.main')

@section('content')
    @foreach($products as $product)
        <div class="alert alert-primary" role="alert">
            <div class="row" style="vertical-align: center">
                <div class="col-3">
                    <img src="http://pure-inlet-68029.herokuapp.com/images/{{$product->picture}}" width="250">
                </div>
                <div class="col-3" style="margin-top: auto; margin-bottom: auto">
                    <h6>Customer: <br>{{\App\Customer::find($product->customer_id)->first_name}} {{\App\Customer::find($product->customer_id)->last_name}}</h6>
                </div>
                <div class="col-3" style="margin-top: auto; margin-bottom: auto">
                    <h5><span data-countdown="{{$product->due_date}}"></span> left</h5>
                </div>
                <div class="col-3" style="margin-top: auto; margin-bottom: auto">
                    <h6 style="margin: 0px">Details</h6>
                    <p style="margin: 0px">{{ $product->details }}</p>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        $('[data-countdown]').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('%D days %H:%M:%S'));
            });
        });
    </script>

@endsection