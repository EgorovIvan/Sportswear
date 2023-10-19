<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Transaction;
use App\Queries\CartsQueryBuilder;
use App\Queries\QueryBuilder;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use YooKassa\Model\Notification\NotificationEventType;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;

class PaymentController extends Controller
{
    protected QueryBuilder $cartsQueryBuilder;

    public function __construct(
        CartsQueryBuilder    $cartsQueryBuilder,
    )
    {
        $this->cartsQueryBuilder = $cartsQueryBuilder;
    }

    public function index()
    {
        $transactions = Transaction::orderBy('id', 'desc')->get();
        $resource = $this->cartsQueryBuilder->getProducts();
        $total = 0;
        foreach ($resource as $product) {
            $total = $total + ($product->price * $product->quantity);
        }

        return view('payments.index', ['transactions' => $transactions, 'total' => $total]);
    }

    public function create(Request $request, PaymentService $service)
    {
        $amount = (float)$request->input('amount');
        $description = $request->input('description');

        $transaction = Transaction::create([
           'amount' => $amount,
           'description' => $description
        ]);

        if($transaction) {
            $link = $service->createPayment($amount, $description, [
                'transaction_id' => $transaction->id
            ]);

            return redirect()->away($link);
        }
    }
    public function callback(Request $request, PaymentService $service)
    {
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);
        $notification = (isset($requestBody['event']) && $requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
            ? new NotificationSucceeded($requestBody)
            : new NotificationWaitingForCapture($requestBody);

        $payment = $notification->getObject();

        if(isset($payment->status) && $payment->status === 'waiting_for_capture') {
            $service->getClient()->capturePayment([
                'amount' => $payment->amount,
            ], $payment->id, uniqid('', true));
        }

        if(isset($payment->status) && $payment->status === 'succeeded') {
            if((bool)$payment->paid === true) {
                $metadata = (object)$payment->metadata;
                if (isset($metadata->transaction_id)) {
                    $transactionId = (int)$metadata->transaction_id;
                    $transaction = Transaction::find($transactionId);
                    $transaction->status = PaymentStatus::CONFIRMED;
                    $transaction->save();

                    if (cache()->has('amount')) {
                        cache()->forever('balance', (float)cache()->get('balance') + (float)$payment->amount->value);
                    } else {
                        cache()->forever('balance', (float)$payment->amount->value);
                    }

                }
            }
        }
    }

}
