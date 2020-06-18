@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction"
                        method="post" name="redirect">
                        <h4 align="center">Redirecting To Payment Please Wait..</h4>
                        <h4 align="center">Please Do Not Press Back Button OR Refresh Page</h4>
                        <input type="hidden" size="200" name="encRequest" id="encRequest"
                            value="{{ $encrypted_data }}" />
                        <input type="hidden" name="access_code" id="access_code" value="{{ $access_code }}" />
                    </form>
                    </body>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_after')
<script language='javascript'>
    document.redirect.submit();
</script>
@endsection