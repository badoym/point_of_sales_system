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
                                    <th scope="col">O.R Number</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Cash</th>
                                    <th scope="col">Change</th>
                                    <th scope="col">Tax(12%)</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($totalsales as $index => $sales)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$sales->order_number}}</td>
                                    <td>{{ number_format($sales->grand_total, 2) }}</td>
                                    <td>{{ number_format($sales->cash, 2) }}</td>
                                    <td>{{ number_format($sales->change, 2) }}</td>
                                    <td>{{ number_format($sales->vat, 2) }}</td>
                                    <td>{{ number_format($sales->subtotal, 2) }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('cashier.sales.view', ['order_number' => $sales->order_number]) }}" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2"><strong>Total Amount:</strong></td>
                                    <td><strong>{{ number_format($totalGrand, 2) }}</strong></td>
                                    <td><strong></strong></td>
                                    <td><strong></strong></td>
                                    <td colspan="1"><strong>{{ number_format($totalTax, 2) }}</strong></td>
                                    <td colspan="1"><strong>{{ number_format($totalSub, 2) }}</strong></td>
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
