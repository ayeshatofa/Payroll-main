@extends('layout.master')

@section('title')
    Payment Page
@endsection

@section('content')
    <div class="container col-md-6 mt-5">
        <div class="card">
            <div class="card-header">
                <h4><center><strong>Payment</strong></center></h4>
            </div>
            <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            {{-- @if($existingTransaction)
                <!-- If the user has already been paid, show a message and disable payment -->
                <div class="alert alert-info">
                    Employee have already been paid for the current month.
                </div>
            @else --}}
            @php
                $record = $record->first();
            @endphp
            <form action="{{ route('stripe.charge') }}" method="post" id="payment-form">
                @csrf
                <div class="form-group">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                        <div class="p-3 bg-light bg-opacity-10">
                        <h4 class="card-title mb-3">Payment Summary</h4>
                        <ul class="list-group mb-3">
                        
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Salary for {{ $record->month }}</span>
                                <span>${{ number_format($record->payroll, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tax for {{ $record->month }}</span>
                                <span>-${{ number_format($record->tax_amount, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Salary after tax for {{ $record->month }}</strong>
                                <strong>${{ number_format($record->payable_salary, 2) }}</strong>
                            </li>
                        </ul>
                    </div>
                    </div>
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                    <input type="hidden" name="stripeToken" id="stripeToken">
                    <input type="hidden" name="amount" value="{{ (int) ($record->payable_salary * 100) }}">
                    <input type="hidden" name="user_id" value="{{ $record->user_id}}">
                    <div id="card-button" class="form-control mb-3"></div>
                    <button type="button" class="btn btn-primary btn-block" onclick="createToken()">Pay Now</button>
            </form>
            {{-- @endif --}}
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Create a Stripe client.
    var stripe = Stripe("{{env('STRIPE_KEY')}}");
    // Create an instance of Elements.
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-button');
  
    function createToken() {
        stripe.createToken(cardElement).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                //stripeTokenHandler(result.token);
                document.getElementById('stripeToken').value = result.token.id;
                document.getElementById('payment-form').submit();
            }
        });
    }
</script>
@endsection