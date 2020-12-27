@extends('layouts.android.master-ogani')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-right">
                        <div class="m-3">
                            <a href="javascript:history.back()" class="text-primary"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="checkout__order">
                        <h4>Your Order</h4>
                        <div class="checkout__order__products">Products <span>Total</span></div>
                        <ul>
                            <li>Vegetable’s Package <span>$75.99</span></li>
                            <li>Fresh Vegetable <span>$151.99</span></li>
                            <li>Organic Bananas <span>$53.99</span></li>
                        </ul>
                        <div class="checkout__order__subtotal">Subtotal <span>$750.99</span></div>
                        <div class="checkout__order__total">Total <span>$750.99</span></div>
                        <div class="checkout__input__checkbox">
                            <label for="acc-or">
                                Create an account?
                                <input type="checkbox" id="acc-or">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua.</p>
                        <div class="checkout__input__checkbox">
                            <label for="payment">
                                Check Payment
                                <input type="checkbox" id="payment">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="paypal">
                                Paypal
                                <input type="checkbox" id="paypal">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <button type="submit" class="site-btn">PLACE ORDER</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
