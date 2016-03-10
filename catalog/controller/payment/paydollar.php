<?php
class ControllerPaymentPayDollar extends Controller {
	public function index() {
		$this->load->language('payment/paydollar');

		$data['text_testmode'] = $this->language->get('text_testmode');
		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['testmode'] = $this->config->get('paydollar_test');

		if (!$this->config->get('paydollar_test')) {
			$data['action'] = 'https://test.paydollar.com/b2cDemo/eng/payment/payForm.jsp';
		} else {
			$data['action'] = 'https://www.paydollar.com/b2c2/eng/payment/payForm.jsp';
		}

		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		if ($order_info) {
			$merchantId = $this->config->get('paydollar_merchantid');
			$data['merchantId'] = $this->config->get('paydollar_merchantid');
			$amount = $this->currency->format ($order_info['total'], $order_info['currency_code'], '', FALSE);
			$data['amount'] = $this->currency->format ($order_info['total'], $order_info['currency_code'], '', FALSE);
			$orderRef = $this->session->data ['order_id'];
			$data['orderRef'] = $this->session->data ['order_id'];
			$currCode = $this->getCurrencyIso($order_info['currency_code']);
			$data['currCode'] = $this->getCurrencyIso($order_info['currency_code']);
			$data['successUrl'] = $this->url->link('checkout/success');
			$data['failUrl'] = $this->url->link('checkout/failure');
			$data['cancelUrl'] = $this->url->link('checkout/checkout');
			$payType = $this->config->get('paydollar_paytype');
			$data['payType'] = $this->config->get('paydollar_paytype');
			
			$language_code = $this->session->data['language'];
			
			switch($language_code){
				case 'en':
					$data['lang'] = 'E';
					break;
				case 'cn':
					$data['lang'] = 'X';
					break;
				case 'zh':
					$data['lang'] = 'C';
					break;
				case 'ja':
					$data['lang'] = 'J';
					break;
				case 'th':
					$data['lang'] = 'T';
					break;		
				case 'fr':
					$data['lang'] = 'F';
					break;
				case 'de':
					$data['lang'] = 'G';
					break;
				case 'ru':
					$data['lang'] = 'R';
					break;
				case 'es':
					$data['lang'] = 'S';
					break;
				case 'vi':
					$data['lang'] = 'V';
					break;
				default:
					$data['lang'] = 'E';
			}
			
			
			$data['mpsMode'] = $this->config->get ('paydollar_mpsmode');
			$data['payMethod'] = $this->config->get ('paydollar_paymethod');
			
			$secureHashSecret = trim($this->config->get ('paydollar_securehash'));
			
			if ($secureHashSecret) {
				
				$data ['secureHash'] = $this->generatePaymentSecureHash ( $merchantId, $orderRef, $currCode, $amount, $payType, $secureHashSecret );
				
			} else {
				
				$data ['secureHash'] = '';
				
			}
			
			$data['remark'] = $order_info['comment'];
			$data['redirect'] = '';
			$data['oriCountry'] = '';
			$data['destCountry'] = '';
			

			return $this->load->view('payment/paydollar', $data);
			
		}
	}

	public function callback() {
		if (isset($this->request->post['custom'])) {
			$order_id = $this->request->post['custom'];
		} else {
			$order_id = 0;
		}

		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($order_id);

		if ($order_info) {
			$request = 'cmd=_notify-validate';

			foreach ($this->request->post as $key => $value) {
				$request .= '&' . $key . '=' . urlencode(html_entity_decode($value, ENT_QUOTES, 'UTF-8'));
			}

			if (!$this->config->get('paydollar_test')) {
				$curl = curl_init('https://www.paypal.com/cgi-bin/webscr');
			} else {
				$curl = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
			}

			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			$response = curl_exec($curl);

			if (!$response) {
				$this->log->write('PAYDOLLAR :: CURL failed ' . curl_error($curl) . '(' . curl_errno($curl) . ')');
			}

			if ($this->config->get('paydollar_debug')) {
				$this->log->write('PAYDOLLAR :: IPN REQUEST: ' . $request);
				$this->log->write('PAYDOLLAR :: IPN RESPONSE: ' . $response);
			}

			if ((strcmp($response, 'VERIFIED') == 0 || strcmp($response, 'UNVERIFIED') == 0) && isset($this->request->post['payment_status'])) {
				$order_status_id = $this->config->get('config_order_status_id');

				switch($this->request->post['payment_status']) {
					case 'Canceled_Reversal':
						$order_status_id = $this->config->get('paydollar_canceled_reversal_status_id');
						break;
					case 'Completed':
						$receiver_match = (strtolower($this->request->post['receiver_merchantid']) == strtolower($this->config->get('paydollar_merchantid')));

						$total_paid_match = ((float)$this->request->post['mc_gross'] == $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false));

						if ($receiver_match && $total_paid_match) {
							$order_status_id = $this->config->get('paydollar_completed_status_id');
						}
						
						if (!$receiver_match) {
							$this->log->write('PAYDOLLAR :: RECEIVER EMAIL MISMATCH! ' . strtolower($this->request->post['receiver_merchantid']));
						}
						
						if (!$total_paid_match) {
							$this->log->write('PAYDOLLAR :: TOTAL PAID MISMATCH! ' . $this->request->post['mc_gross']);
						}
						break;
					case 'Denied':
						$order_status_id = $this->config->get('paydollar_denied_status_id');
						break;
					case 'Expired':
						$order_status_id = $this->config->get('paydollar_expired_status_id');
						break;
					case 'Failed':
						$order_status_id = $this->config->get('paydollar_failed_status_id');
						break;
					case 'Pending':
						$order_status_id = $this->config->get('paydollar_pending_status_id');
						break;
					case 'Processed':
						$order_status_id = $this->config->get('paydollar_processed_status_id');
						break;
					case 'Refunded':
						$order_status_id = $this->config->get('paydollar_refunded_status_id');
						break;
					case 'Reversed':
						$order_status_id = $this->config->get('paydollar_reversed_status_id');
						break;
					case 'Voided':
						$order_status_id = $this->config->get('paydollar_voided_status_id');
						break;
				}

				$this->model_checkout_order->addOrderHistory($order_id, $order_status_id);
			} else {
				$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('config_order_status_id'));
			}

			curl_close($curl);
		}
	}
	
	private function getCurrencyIso($currency_code) {
		switch($currency_code){
		case 'HKD':
			$cur = '344';
			break;
		case 'USD':
			$cur = '840';
			break;
		case 'SGD':
			$cur = '702';
			break;
		case 'CNY':
			$cur = '156';
			break;
		case 'JPY':
			$cur = '392';
			break;		
		case 'TWD':
			$cur = '901';
			break;
		case 'AUD':
			$cur = '036';
			break;
		case 'EUR':
			$cur = '978';
			break;
		case 'GBP':
			$cur = '826';
			break;
		case 'CAD':
			$cur = '124';
			break;
		case 'MOP':
			$cur = '446';
			break;
		case 'PHP':
			$cur = '608';
			break;
		case 'THB':
			$cur = '764';
			break;
		case 'MYR':
			$cur = '458';
			break;
		case 'IDR':
			$cur = '360';
			break;
		case 'KRW':
			$cur = '410';
			break;
		case 'SAR':
			$cur = '682';
			break;
		case 'NZD':
			$cur = '554';
			break;
		case 'AED':
			$cur = '784';
			break;
		case 'BND':
			$cur = '096';
			break;
		case 'VND':
			$cur = '704';
			break;
		case 'INR':
			$cur = '356';
			break;
		default:
			$cur = '344';
		}		
		return $cur;
	}
	
	
	private function getCurrency($currCode){
		$currency = "USD";
		if ($currCode = '344') {
			$currency == "HKD";
		} elseif ($currCode = '840') {
			$currency == "USD";
		} elseif ($currCode = '702') {
			$currency == "SGD";
		} elseif ($currCode = '156') {
			$currency == "CNY";
		} elseif ($currCode = '392') {
			$currency == "JPY";
		} elseif ($currCode = '901') {
			$currency == "TWD";
		} elseif ($currCode = '036') {
			$currency == "AUD";
		} elseif ($currCode = '978') {
			$currency == "EUR";
		} elseif ($currCode = '826') {
			$currency == "GBP";
		} elseif ($currCode = '124') {
			$currency == "CAD";
		} elseif ($currCode = '446') {
			$currency == "MOP";
		} elseif ($currCode = '608') {
			$currency == "PHP";
		} elseif ($currCode = '764') {
			$currency == "THB";
		} elseif ($currCode = '458') {
			$currency == "MYR";
		} elseif ($currCode = '360') {
			$currency == "IDR";
		} elseif ($currCode = '410') {
			$currency == "KRW";
		} elseif ($currCode = '682') {
			$currency == "SAR";
		} elseif ($currCode = '554') {
			$currency == "NZD";
		} elseif ($currCode = '784') {
			$currency == "AED";
		} elseif ($currCode = '096') {
			$currency == "BND";
		} elseif ($currCode = '704') {
			$currency == "VND";
		} elseif ($currCode = '356') {
			$currency == "INR";
		} 
		
		return $currency;
	}
	
	private function generatePaymentSecureHash($merchantId, $merchantReferenceNumber, $currencyCode, $amount, $paymentType, $secureHashSecret) {

		$buffer = $merchantId . '|' . $merchantReferenceNumber . '|' . $currencyCode . '|' . $amount . '|' . $paymentType . '|' . $secureHashSecret;
		
		return sha1($buffer);

	}

	private function verifyPaymentDatafeed($src, $prc, $successCode, $merchantReferenceNumber, $paydollarReferenceNumber, $currencyCode, $amount, $payerAuthenticationStatus, $secureHashSecret, $secureHash) {

		$buffer = $src . '|' . $prc . '|' . $successCode . '|' . $merchantReferenceNumber . '|' . $paydollarReferenceNumber . '|' . $currencyCode . '|' . $amount . '|' . $payerAuthenticationStatus . '|' . $secureHashSecret;

		$verifyData = sha1($buffer);

		if ($secureHash == $verifyData) {
			return true;
		}

		return false;

	}
	
}