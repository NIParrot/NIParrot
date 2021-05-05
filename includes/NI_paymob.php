<?php

use Paymob\PayMob;

class NI_paymob
{
    protected $paymobObj;
    protected $auth;
    public function __construct()
    {
        $config = [
            'PayMob_User_Name' => PayMob_User_Name,
            'PayMob_Password' => PayMob_Password,
            'PayMob_Integration_Id' => PayMob_Integration_Id
        ];

        $this->paymobObj = new PayMob($config);
        $this->auth = PayMob::AuthenticationRequest();
    }

    public function order(array $data)
    {
        $order = PayMob::OrderRegistrationAPI(
            [
            'auth_token' => $this->auth->token,
            'amount_cents' => $data['price'] * 100,
            'currency' => 'EGP',
            'delivery_needed' => $data['delivery_needed'] ?? false,
            'merchant_order_id' => $data['DB_product_id'],
            'items' => [$data['items'] ?? null]
            ]
        );
        return $order;
    }

    public function paymentkey(NI_paymob $order, array $user)
    {
        $PaymentKey = PayMob::PaymentKeyRequest(
            [
            'auth_token' => $this->auth->token,
            'amount_cents' => 150 * 100,
            'currency' => 'EGP',
            'order_id' => $order->id, // from step 4
            "billing_data" => $user
            /*   [ // put your client information
                "apartment" => "803",
                "email" => "claudette09@exa.com",
                "floor" => "42",
                "first_name" => "Clifford",
                "street" => "Ethan Land",
                "building" => "8028",
                "phone_number" => "+86(8)9135210487",
                "shipping_method" => "PKG",
                "postal_code" => "01898",
                "city" => "Jaskolskiburgh",
                "country" => "CR",
                "last_name" => "Nicolas",
                "state" => "Utah"
            ] */
            ]
        );
        return $PaymentKey;
    }
}
if (USEPayMob == true) {
    // code...
    $NI_paymob = new NI_paymob();
}