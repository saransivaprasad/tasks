@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Name:</td>
                                <td>Product {{ rand() }}</td>
                            </tr>
                            <tr>
                                <td>Description:</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor malesuada
                                    mattis. Fusce auctor scelerisque erat
                                    non congue. Mauris augue urna, euismod quis magna blandit, consectetur ultrices
                                    purus. Orci varius natoque penatibus et
                                    magnis dis parturient montes, nascetur ridiculus mus. Ut aliquam sit amet dui nec
                                    pretium. Cras efficitur arcu sed dolor
                                    molestie, quis pretium ipsum condimentum. Aliquam a lacus turpis. Sed rutrum elit
                                    nisi, ut facilisis lectus ultrices
                                    vitae. Aenean ultrices mollis nisl, tempus iaculis enim. Vivamus eget quam nec nisi
                                    vestibulum suscipit id quis metus.
                                    Nam quis pretium risus, sit amet congue nibh. Nam blandit odio odio, vitae faucibus
                                    justo semper sed. Fusce blandit
                                    faucibus cursus. Suspendisse justo dolor, malesuada sed condimentum accumsan,
                                    faucibus sed augue. Vivamus auctor lectus
                                    ac velit lacinia ultricies. Nunc et dictum nisi.</td>
                            </tr>
                            <tr>
                                <td>Price:</td>
                                <td>AED {{ $price }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('payment') }}" class="btn btn-primary">Procced to Payment</a>
                    </body>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection