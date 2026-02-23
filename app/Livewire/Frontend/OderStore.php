<?php

namespace App\Livewire\Frontend;

use App\Exceptions\GeneralException;
use App\Models\CartItem;
use App\Models\Order;
use App\Services\Api\pivotService;
use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OderStore extends Component
{
    public $order;
    public $total_amount;

    public function mount()
    {
        // get total amount
        foreach ($this->order as $item) {
            $payload = json_decode($item->payload);
            $this->total_amount += $payload->package_price * $item['quantity'];
        }
    }

    public function submit(OrderService $orderService, PaymentService $paymentService, pivotService $apiService)
    {
        // dd($this->order);
        DB::beginTransaction();
        try {
            $data = $orderService->store([
                'user_id' => auth()->id(),
                'order_number' => uniqid(),
                'status' => Order::STATUS_FAILED,
                'total_amount' =>  $this->total_amount,
            ]);

            foreach ($this->order as $item) {
                $payload = json_decode($item->payload);
                $orderService->createOrderItem($data, [
                    'package_id' => $item['package_id'],
                    'payload' => json_encode([
                        'package_id' => $item['package_id'],
                        'type' => $item['type'],
                        'sub_package_key' => $item['sub_package_key'],
                    ]),
                    'contract_type' => $item['contract_type'],
                    'quantity' => $item['quantity'],
                    'price' => $payload->package_price,
                ]);

                CartItem::where('id', $item['id'])->delete();
            }

            $response = $apiService->redirectPayment($data);
            // dd($response);

            if ($response->getStatusCode() == 200) {
                $body = $response->getData();
                $data = $body->data;

                $payload = json_encode($body);

                $paymentService->store([
                    'order_number' => $data->clientReferenceId,
                    'transaction_id' => $data->id,
                    'currency' => $data->amount->currency,
                    'amount' => $data->amount->value,
                    'status' => $data->status,
                    'payment_url' => $data->paymentUrl,
                    'payload' => $payload,
                ]);

                DB::commit();
                return redirect()->to($data->paymentUrl);
            }else {
                DB::rollBack();
                return redirect()->route('frontend.order.index')->with('flash_warning', "The request was invalid, or an error occurred in downstream provider");
            }

            return redirect()->route('frontend.order.payment', $data->order_number);
        }catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('frontend.order.index')->with('flash_warning', "The request was invalid, or an error occurred in downstream provider");
            throw new GeneralException(__('There was a problem creating this order & subscription. Please try again.'));
        }
        DB::commit();
    }


    public function render()
    {
        return view('livewire.frontend.oder-store');
    }
}
