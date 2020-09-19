<x-frontend>
   <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('index')}}">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th colspan="3">Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="shoppingcart_table">
                                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Notes</h5>
                            <form action="#">
                                <textarea class="form-control mb-5" placeholder="Note" id="notes" ></textarea>                      
                            </form>
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6" >
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                           
                        <li >Total <span class="shoppingcartTotal"></span></li>
                        </ul>
                        @if(Auth::check())
                        <a href="javascript:void(0)" class="primary-btn checkoutBtn">PROCEED TO CHECKOUT</a>
                        @else
                        <a href="{{route('login')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

</x-frontend>