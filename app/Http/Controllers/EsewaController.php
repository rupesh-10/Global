<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SaleItem;
use App\Sale;
use App\Esewa;
class EsewaController extends Controller
{
    /**
     * @param $order_id
     * @param Request $request
     */
    public function payment($sale_id, Request $request)
    {
        $sales = SaleItem::where('sale_id',$sale_id);
        $price = 0; 
        foreach($sales as $sale){
            $price += $sale->price;
        }   
        $gateway = with(new Esewa);

        try {
            $response = $gateway->purchase([
                'amount' => $gateway->formatAmount($price),
                'totalAmount' => $gateway->formatAmount($price),
                'productCode' => 'GS',
                'failedUrl' => $gateway->getFailedUrl($sales),
                'returnUrl' => $gateway->getReturnUrl($sales),
            ], $request);

        } catch (Exception $e) {
            $sale->update(['payment_status' => Sale::PAYMENT_PENDING]);

            return redirect()
                ->route('checkout.payment.esewa.failed', [$sale_id])
                ->with('message', sprintf("Your payment failed with error: %s", $e->getMessage()));
        }

        if ($response->isRedirect()) {
            $response->redirect();
        }

        return redirect()->back()->with([
            'message' => "We're unable to process your payment at the moment, please try again !",
        ]);
    }

    /**
     * @param $sale_id
     * @param Request $request
     */
    public function completed($sale_id, Request $request)
    {
        $sale = Sale::findorFail($sale_id);
        $saleitems = SaleItem::where('sale_id',$sale_id);
        foreach($saleitems as $saleitem){
            $price += $saleitem->price;
        }   
        $gateway = with(new Esewa);

        $response = $gateway->verifyPayment([
            'amount' => $gateway->formatAmount($price),
            'referenceNumber' => $request->get('refId'),
            'productCode' => $request->get('oid'),
        ], $request);

        if ($response->isSuccessful()) {
            $sale->update([
                'transaction_id' => $request->get('refId'),
                'payment_status' => Sale::PAYMENT_COMPLETED,
            ]);
               
            return redirect()->route('/')->with([
                'success' => 'Thank you for your shopping, Your recent payment was successful.',
            ]);
        }

        return redirect()->route('/')->with([
            'danger' => 'Thank you for your shopping, However, the payment has been declined.',
        ]);
         $client = $sale->client_name;
         $number = $sale->phone_number;
         $api_url = "http://api.sparrowsms.com/v2/sms/?";
          http_build_query(array(
              'token' => '<token provided>', //BY Spaarow SMS ko Account
              'from' => 'Global Suppliers',
              'to' => $number,
              'text' => "Dear $client your Order has been Successfully noted, Our employee will shortly call you",
          ));
          $response = file_get_contents($api_url);
    }

    /**
     * @param $sale_id
     * @param Request $request
     */
    public function failed($sale_id, Request $request)
    {
        $sale = Sale::findorFail($sale_id);
        return view('esewa.checkout', compact('sale'));
    }
}
