<x-app-layout>
    <div class="py-6">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-1200">
                    <!DOCTYPE html>
                        <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Cashier POS</title>
                                <script src="https://cdn.tailwindcss.com"></script>
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            </head>
                            @if(session('success'))
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Congratulations!',
                                            text: '{{ session("success") }}',
                                            confirmButtonText: 'OK',
                                            confirmButtonColor: '#3085d6'
                                        });
                                    });
                                </script>
                            @endif
                            <body class="bg-gray-200 p-6">

                                <div x-data="posApp()" class="grid grid-cols-3 gap-6 max-w-12xl mx-auto">
                                    <!-- LEFT SIDE -->
                                    <div class="col-span-2 bg-white p-4">
                                        <!-- Search -->
                                        <div class="flex gap-2 mb-4">
                                            <input type="text" placeholder="Search product..."
                                                class="flex-1 px-3 py-2 border rounded-lg focus:ring focus:ring-yellow-300"
                                                x-model="search">
                                        </div>

                                        <!-- Product List -->
                                        <h3 class="text-lg font-semibold mb-3">Product List</h3>
                                        <div class="grid grid-cols-4 gap-4">
                                            @foreach($totalproduct as $product)
                                            <div 
                                                x-show="$el.querySelector('h3').innerText.toLowerCase().includes(search.toLowerCase())"
                                                class="max-w-sm rounded-2xl overflow-hidden shadow-lg bg-white flex flex-col">
                                                
                                                <div class="relative">
                                                    <img class="w-full h-40 object-cover" 
                                                        src="{{ asset('storage/' . $product->image) }}" 
                                                        alt="{{$product->productname}}">
                                                </div>
                                                
                                                <div class="p-4 flex flex-col flex-1">
                                                    <h3 class="flex justify-between items-center text-lg font-bold text-gray-800">
                                                        <span>{{$product->productname}}</span>
                                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                                    {{ $product->stock > 5 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                            {{$product->stock}} left
                                                        </span>
                                                    </h3>
                                                    <p class="text-sm text-gray-500 mt-1">{{$product->description}}</p>
                                                    <!-- Spacer para ipush ang button area sa ubos -->
                                                    <div class="mt-auto">
                                                        <div class="flex items-center justify-between">
                                                            <span class="text-xl font-bold text-orange-500">₱{{$product->saleprice}}</span>
                                                            <button 
                                                                @click="addItem({id:{{$product->id}}, name:'{{$product->productname}}', price:{{$product->saleprice}}})"
                                                                class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 disabled:opacity-50 disabled:cursor-not-allowed"
                                                                {{ $product->stock == 0 || $product->status == 0 ? 'disabled' : '' }}>
                                                                ADD
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- RIGHT SIDE -->
                                    <form action="{{ route('cashier.checkout.store') }}" method="POST">
                                        @csrf
                                        <div class="col-span-1 bg-white shadow rounded-2xl p-4 flex flex-col">
                                            <h3 class="text-lg font-semibold mb-3">Order List</h3>
                                            <table class="w-full text-sm flex-1">
                                                <thead class="border-b font-semibold text-gray-700">
                                                    <tr>
                                                        <th class="py-2 text-left">Item</th>
                                                        <th class="py-2 text-center">Qty</th>
                                                        <th class="py-2 text-right">Price</th>
                                                        <th class="py-2 text-right">Total</th>
                                                        <th class="py-2 text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <template x-for="(item, index) in cart" :key="item.id">
                                                        <tr>
                                                            <td class="py-2 text-lg" x-text="item.name"></td>
                                                            <td class="py-2 text-center text-lg">
                                                                <input type="number" min="1" class="w-12 h-7 border rounded text-center" x-model.number="item.qty" @input="updateTotal()">
                                                            </td>
                                                            <td class="py-2 text-right text-lg" x-text="'₱'+item.price"></td>
                                                            <td class="py-2 text-right text-lg" x-text="'₱'+(item.price * item.qty)"></td>
                                                            <td class="py-2 text-center text-lg">
                                                                <button type="button" @click="removeItem(index)" class="text-red-500 hover:text-red-700">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                                                        <path fill-rule="evenodd" d="M10 8.586L15.293 3.293a1 1 0 011.414 1.414L11.414 10l5.293 5.293a1 1 0 01-1.414 1.414L10 11.414l-5.293 5.293a1 1 0 01-1.414-1.414L8.586 10 3.293 4.707a1 1 0 011.414-1.414L10 8.586z" clip-rule="evenodd" />
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                            <!-- Hidden inputs to send data to server -->
                                                            <input type="hidden" :name="'items['+index+'][product_id]'" :value="item.id">
                                                            <input type="hidden" :name="'items['+index+'][price]'" :value="item.price">
                                                            <input type="hidden" :name="'items['+index+'][qty]'" :value="item.qty">
                                                            <input type="hidden" :name="'items['+index+'][total]'" :value="item.price * item.qty">
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                            
                                            <!-- Grand Total -->
                                            <div class="mt-4 border-t pt-4">
                                                <p class="text-2xl font-bold text-right">
                                                    Grand Total: <span class="text-yellow-500 text-3xl" x-text="'₱'+grandTotal"></span>
                                                </p>
                                                
                                                <!-- Hidden input to pass grandTotal to controller -->
                                                <input type="hidden" name="grand_total" :value="grandTotal">

                                                <input type="number" x-model.number="payment" @input="computeChange()"
                                                    class="text-2xl w-full py-3 px-4 rounded-lg shadow mt-2"
                                                    name="cash" placeholder="Enter Amount">

                                                <input type="text" x-model="changeDisplay" disabled
                                                    class="text-2xl w-full py-3 px-4 rounded-lg shadow mt-2"
                                                    placeholder="Change">

                                                <button type="submit"
                                                    :disabled="cart.length === 0 || payment < grandTotal"
                                                    class="w-full bg-yellow-500 text-white py-3 px-4 rounded-lg shadow mt-2 
                                                        disabled:opacity-50 disabled:cursor-not-allowed transition">
                                                    Proceed Payment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div> 
                            </body>
                            <script src="//unpkg.com/alpinejs" defer></script>

                            <script>
                                function posApp() {
                                    return {
                                        cart: [],
                                        search: '',
                                        grandTotal: 0,
                                        payment: 0,             // stores payment input
                                        change: 0,              // stores numeric change
                                        changeDisplay: '',      // formatted change for display

                                        addItem(product) {
                                            let exist = this.cart.find(item => item.id === product.id);
                                            if(exist) {
                                                exist.qty++;
                                            } else {
                                                this.cart.push({...product, qty:1});
                                            }
                                            this.updateTotal();
                                        },
                                        removeItem(index) {
                                            this.cart.splice(index, 1);
                                            this.updateTotal();
                                        },
                                        updateTotal() {
                                            this.grandTotal = this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                                            this.computeChange();
                                        },
                                        computeChange() {
                                            this.change = this.payment - this.grandTotal;
                                            this.changeDisplay = this.change >= 0 ? '₱'+this.change.toFixed(2) : '';
                                        },
                                        submitOrder() {
                                            if(this.cart.length === 0){
                                                alert('Cart is empty!');
                                                return;
                                            }
                                            if(this.payment < this.grandTotal){
                                                alert('Payment is not enough!');
                                                return;
                                            }
                                            // Submit the form normally
                                            this.$el.querySelector('form').submit();
                                        }
                                    }
                                }

                            </script>
                        </html>
                    <!--<!DOCTYPE html> -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
