<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use App\Models\Package;
use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

class Cart extends Component
{
    public $items = [];

    public $totalAmount = 0;

    public function mount()
    {
        $this->getCartItems();
    }

    function getCartItems()
    {
        $cart = CartItem::where('user_id', auth()->id())->get();

        foreach ($cart as $item) {
            $payload = json_decode($item->payload);
            $getDetail = $this->getDetailItemProperty($item->package_id, $payload->type, $payload->sub_package_key);
            $this->items[] = [
                'id' => (int) $item->id,
                'package_id' => $item->package_id,
                'category' => $item->package->category->name,
                'package_name' => $item->package->title,
                'type' => $payload->type,
                'sub_package_key' => $payload->sub_package_key,
                'min_contract' => $item->min_contract,
                'contract_type' => $item->contract_type,
                'quantity' => $item->quantity,
                'price' => $getDetail['price'],
                'sub_package' => $getDetail['sub_package'],
                'message' => null,
            ];
        }
    }

    public function getTotalAmoun()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $this->totalAmount = $total;

        return $total;
    }


    public function getDetailItemProperty($package_id, $type, $key)
    {
        $package = Package::where('id', $package_id)->first();
        $payload = json_decode($package->payload);

        switch ($type) {
            case 'table':
                $data = collect($payload)->where('type', $type)->first();
                return [
                    'price' => (int) $data->data->table[$key]->data->package_price,
                    'sub_package' => (array) $data->data->table[$key]->data->table,
                ];
                break;
            case 'list':
                    $data = collect($payload)->where('type', $type)->first();
                return [
                    'price' => (int) $data->data->list[$key]->package_price,
                    'sub_package' => (array) $data->data->list[$key],
                ];
                break;

            default:
                $data = collect($payload)->where('type', 'button')->first();
                return [
                    'price' => (int) $data->data->package_price,
                    'sub_package' => null,
                ];
                break;
        }
    }

    // static function itemDetail($item)
    // {
    //     $data = json_decode($item);

    //     $package = Package::where('id', $data->package_id)
    //         ->where('slug', $data->slug)
    //         ->firstOrFail();

    //     $sub_package = json_decode($package->payload);

    //     if ($data->type != 'table' && $data->type != 'list') {
    //         return $sub_package;
    //     }else{
    //         $sub_package = collect($sub_package)->where('type', $data->type)->first();

    //         switch ($data->type) {
    //             case 'table':
    //                 # code...
    //                 dd($sub_package->data->table[$data->sub_package_key]);
    //                 break;
    //             case 'list':
    //                 # code...
    //                 dd($sub_package->data->list[$data->sub_package_key]);
    //                 break;

    //             default:
    //                 # code...
    //                 dd('Type not found');
    //                 break;
    //         }
    //     }

    //     return $data;
    // }

    public function updateQuantity($id, $quantity)
    {
        $data = auth()->user()->cartItems->where('id', $id)->first();
        $data->quantity = $quantity;
        $data->save();
    }

    public function incrementQuantity($id, $key)
    {
        $dbItem = auth()->user()->cartItems->where('id', $id)->first();

        switch ($this->items[$key]['contract_type']) {
            case 'daily':
                $this->items[$key]['message'] = null;
                $this->items[$key]['quantity'] = $this->items[$key]['quantity'] + 1;
                $dbItem->quantity = $dbItem->quantity + 1;
                $dbItem->save();
                break;

            case 'monthly':
                if ($this->items[$key]['min_contract'] == 12) {
                    $this->items[$key]['message'] = null;
                    $this->items[$key]['quantity'] = $this->items[$key]['quantity'] + 12;
                    $dbItem->quantity = $dbItem->quantity + 12;
                    $dbItem->save();
                }else{
                    $this->items[$key]['message'] = null;
                    $this->items[$key]['quantity'] = $this->items[$key]['quantity'] + 1;
                    $dbItem->quantity = $dbItem->quantity + 1;
                    $dbItem->save();
                }
                break;

            case 'yearly':
                    $this->items[$key]['message'] = null;
                    $this->items[$key]['quantity'] = $this->items[$key]['quantity'] + 1;
                    $dbItem->quantity = $dbItem->quantity + 1;
                    $dbItem->save();
                break;

            case 'periode':
                return;
                break;
            case 'onetime':
                return;
                break;
            default:
                return;
                break;
        }
    }

    public function decrementQuantity($id, $key)
    {
        $dbItem = auth()->user()->cartItems->where('id', $id)->first();

        switch ($this->items[$key]['contract_type']) {
            case 'daily':

                if ($this->items[$key]['quantity'] <= $this->items[$key]['min_contract']) {
                    $this->items[$key]['message'] = 'Minimal pemesanan untuk paket ini adalah ' . $this->items[$key]['min_contract'] . ' hari';
                    return;
                }

                $this->items[$key]['message'] = null;
                $this->items[$key]['quantity'] = $this->items[$key]['quantity'] - 1;
                $dbItem->quantity = $dbItem->quantity - 1;
                $dbItem->save();
                break;

            case 'monthly':

                if ($this->items[$key]['min_contract'] == 12) {
                    if ($this->items[$key]['quantity'] <= $this->items[$key]['min_contract']) {
                        $this->items[$key]['message'] = 'Minimal pemesanan untuk paket ini adalah ' . $this->items[$key]['min_contract'] . ' bulan / 1 tahun';
                        return;
                    }

                    $this->items[$key]['message'] = null;
                    $this->items[$key]['quantity'] = $this->items[$key]['quantity'] - 12;
                    $dbItem->quantity = $dbItem->quantity - 12;
                    $dbItem->save();
                }else{
                    if ($this->items[$key]['quantity'] <= $this->items[$key]['min_contract']) {
                        $this->items[$key]['message'] = 'Minimal pemesanan untuk paket ini adalah ' . $this->items[$key]['min_contract'] . ' bulan';
                        return;
                    }

                    $this->items[$key]['message'] = null;
                    $this->items[$key]['quantity'] = $this->items[$key]['quantity'] - 1;
                    $dbItem->quantity = $dbItem->quantity - 1;
                    $dbItem->save();
                }
                break;

            case 'yearly':

                if ($this->items[$key]['quantity'] <= $this->items[$key]['min_contract']) {
                    $this->items[$key]['message'] = 'Minimal pemesanan untuk paket ini adalah ' . $this->items[$key]['min_contract'] . ' tahun';
                    return;
                }

                $this->items[$key]['message'] = null;
                $this->items[$key]['quantity'] = $this->items[$key]['quantity'] - 1;
                $dbItem->quantity = $dbItem->quantity - 1;
                $dbItem->save();
                break;

            case 'periode':
                return;
                break;
            case 'onetime':
                return;
                break;
            default:
                return;
                break;
        }
    }

    public function removeItem($id, $key)
    {
        unset($this->items[$key]);
        $data = auth()->user()->cartItems->where('id', $id)->first();
        $data->delete();

        $count = CartItem::select('id')->where('user_id', auth()->id())->get();

        $this->dispatch('setCartCount', $count->count());
    }

    public function checkout()
    {
        DB::beginTransaction();
        try {
             $order = Order::create([
            'user_id' => auth()->id(),
                'order_number' => uniqid(),
                'total_amount' =>  $this->totalAmount,
            ]);

            foreach ($this->items as $item) {
                $order->orderItems()->create([
                    'package_id' => $item['package_id'],
                    'payload' => json_encode([
                        'package_id' => $item['package_id'],
                        'type' => $item['type'],
                        'sub_package_key' => $item['sub_package_key'],
                    ]),
                    'contract_type' => $item['contract_type'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                CartItem::where('id', $item['id'])->delete();
            }
        }catch (\Throwable $th) {
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating this order & subscription. Please try again.'));
        }
        DB::commit();

        return redirect()->route('frontend.order.payment', $order->order_number);
    }

    public function render()
    {
        return view('livewire.frontend.cart')->with([
            'totalPrice' => $this->getTotalAmoun()
        ]);
    }
}
