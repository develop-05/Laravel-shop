<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>


    <div class="container mt-5">

        <h2 class="mb-4">Shopping Cart</h2>
        @php $total = 0; @endphp

        @if (count($cart) > 0)
            <table class="table table-bordered align-middle">


                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th width="150">Price</th>
                        <th width="120">Quantity</th>
                        <th width="150">Total</th>
                        <th width="90">Action</th>
                        <th width="90">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                        @php
                            $itemTotal = $item['price'] * $item['quantity'];
                            $total += $itemTotal;
                        @endphp

                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['price'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $itemTotal }}</td>
                            <td class="d-flex gap-2 align-items-center">

                                <form action="{{ route('cart.decrease', $item['id']) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary">➖</button>
                                </form>

                                {{ $item['quantity'] }}

                                <form action="{{ route('cart.increase', $item['id']) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary">➕</button>
                                </form>

                            </td>
                            <td>
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-4">

                <h4>Total: ${{ $total }}</h4>

                <form action="{{ route('cart.confirm') }}" method="POST">
                    @csrf
                    <button class="btn btn-success btn-lg">
                        ✔ Confirm Order
                    </button>
                </form>

            </div>
        @else
            Cart is empty
        @endif

    </div>


</body>

</html>
