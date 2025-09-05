<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
                        <title>Document</title>
                    </head>
                    <body>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">O.R. Number</th>
                                    <th scope="col">Food Item</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $index => $sales)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <th>{{$sales->order_number}}</th>
                                    <th>{{$sales->product_name}}</th>
                                    <th>{{number_format($sales->price, 2)}}</th>
                                    <th>{{$sales->qty}}</th>
                                    <th>{{number_format($sales->total, 2)}}</th>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5"><strong>Total Amount:</strong></td>
                                    <td><strong>{{ number_format($totalsales, 2) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </body>
                    </html>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
