<?php

namespace App\Custom;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;

use Validator;
use Session;
use Auth;

class StripeHelper {
	/* Private global variables */
	private $amount;

	/* Public functions */
	public function __construct($amount = 0) {
		$this->amount = $amount;
	}

	public function checkout($data) {
		// Get amount from either
		if ($this->amount == 0) {
			$amount = $data["amount"];
		} else {
			$amount = $this->amount;
		}

		// Start by creating a charge
		$stripe = Stripe::make(env('STRIPE_SECRET'));

		try {
			// Create a customer
			$customer = $stripe->customers()->create([
				"email" => $data["email"]
			]);

			// Create a card for customer
			$card = $stripe->cards()->create($customer["id"], $data["stripeToken"]);

			$charge = $stripe->charges()->create([
				'customer' => $customer["id"],
				'currency' => 'USD',
				'amount'   => $amount,
				'description' => $data["description"]
			]);

			if($charge['status'] == 'succeeded') {
				return "success";
			} else {
				return "error";
			}
		} catch (Exception $e) {
			return $e->getMessage();
		} catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
			return $e->getMessage();
		} catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
			return $e->getMessage();
		}
	}
}