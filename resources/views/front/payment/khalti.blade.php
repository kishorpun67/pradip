@extends('layouts.front_layout.front_layout')
@section('content')
@include('layouts.front_layout.front1_header')

<section id="do_action">
	<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
		<div class="heading text-center">
			<h3>Your COD has been been placed.</h3>
			<p>Yor order number is {{Session::get('order_id')}}  and  total payable about is Rs.{{Session::get('grand_total')}}.00 </p>
            <script src="https://unpkg.com/khalti-checkout-web@latest/dist/khalti-checkout.iffe.js"></script>
                <input type="hidden" id="khalti" name="khalti" value="{{Session::get('grand_total')}}">
                <button id="payment-button" class="btn btn-primary">Pay with Khalti</button>
            <script>
                var config = {
                    // replace the publicKey with yours
                    "publicKey": "test_public_key_5620298c516a4af183a709744f6a6bbc",
                    "productIdentity": "1234567890",
                    "productName": "Dragon",
                    "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
                    "paymentPreference": [
                        "MOBILE_BANKING",
                        "KHALTI",
                        "EBANKING",
                        "CONNECT_IPS",
                        "SCT",
                        ],
                    "eventHandler": {
                        onSuccess (payload) {
                            // hit merchant api for initiating verfication
                            console.log(payload);
                        },
                        onError (error) {
                            console.log(error);
                        },
                        onClose () {
                            console.log('widget is closing');
                        }
                    }
                };

                var checkout = new KhaltiCheckout(config);
                var btn = document.getElementById("payment-button");
                btn.onclick = function () {
                    var money= {{Session::get('grand_total')}}
                    // minimum transaction amount must be 10, i.e 1000 in paisa.
                    checkout.show({amount: money});
                }
            </script>
            <?php
                $args = http_build_query(array(
                    'token' => 'QUao9cqFzxPgvWJNi9aKac',
                    'amount'  => 1000
                ));

                $url = "https://khalti.com/api/v2/payment/verify/";

                # Make the call using API.
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                $headers = ['Authorization: Key test_secret_key_93c3423b4e534779b915c8129dcd8c1c'];
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                // Response
                $response = curl_exec($ch);
                $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

            ?>
		</div>
	</div>
</section>
@endsection
<?php
    Session::forget('grand_total');
    Session::forget('order_id');
 ?>
