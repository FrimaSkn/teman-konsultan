<?php

namespace App\Livewire\Backend;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Package;
use Livewire\Component;
use App\Models\Subscription;
use App\Models\PackageCategory;
use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

class SubscriptionEdit extends Component
{
    public $record;
    public $users, $categories, $packages;
    public $user_id, $category_id, $package_id, $sub_package_key, $sub_package_type;
    public $price, $contract_type, $min_contract, $quantity, $total_amount;
    public $started_at, $ended_at;
    public $note;

    public function mount()
    {
        // dd($this->record);
        $this->users = User::users()->get();
        $this->categories = PackageCategory::with('packages')->Published()->get();

        $this->user_id = $this->record->user_id;
        $this->category_id = $this->record->orderItem->package->category_id;
        $this->package_id = $this->record->orderItem->package_id;
        $this->quantity = $this->record->orderItem->quantity;
        $this->contract_type = $this->record->orderItem->contract_type;
        if ($this->record->started_at != null && $this->record->ended_at != null) {
            # code...
            $this->started_at = Carbon::createFromFormat('Y-m-d', $this->record->started_at)->format('d/m/Y');
            $this->ended_at = Carbon::createFromFormat('Y-m-d', $this->record->ended_at)->format('d/m/Y');
            $this->dispatch('setDate', [
                'started_at' => $this->record->started_at,
                'ended_at' => $this->record->ended_at
            ]);
        }
        $this->total_amount = $this->record->orderItem->price * $this->record->orderItem->quantity;
        $this->price = $this->record->orderItem->price;
        $payload =  json_decode($this->record->orderItem->payload);
        $this->sub_package_key = $payload->sub_package_key;
        $this->sub_package_type = $payload->type;
        $this->getPackages($this->category_id);
        $this->getSubPackages($this->package_id);
        $this->getSubPackages($this->package_id);
        $this->note = $this->record->note;
    }


    public function updated($property)
    {
        if ($property == 'category_id') {
            $this->package_id = null;
            $this->resetSubPackage();
            $this->getPackages($this->category_id);
        }

        if ($property == 'package_id') {
            $this->resetSubPackage();
            $this->getSubPackages($this->package_id);
            $this->getPackageDetail($this->package_id);
        }

        if ($property == 'sub_package_key') {
            $this->getSubPackageDetail($this->sub_package_type);
        }

        if ($property == 'price' || $property == 'quantity') {
            $this->getTotalAmount();
        }

        if ($property == 'quantity' || $property == 'contract_type') {
            $this->getDate();
        }
    }

    public function getPackages($id)
    {
        $this->packages = Package::where('category_id', $id)->get();

        $mapped = $this->packages->map(function ($package) {
            return [
                'id' => $package->id,
                'text' => $package->title,
                'type' => null,
                'selected' => $package->id == $this->package_id ? true : false
            ];
        });
        $this->dispatch('getPackages', $mapped);
    }

    public function getPackageDetail($id)
    {
        if ($id == null || $id == '-1') {
            return;
        }
        $package = Package::find($id);
        $payload = json_decode($package->payload);

        $data = collect($payload)->where('type', 'button')->first();

        if ($data) {
            $contract = collect($payload)->where('type', 'minimum_contract')->first();

            if ($contract == null) {
                return;
            }

            $this->price = $data->data->package_price;
            $this->contract_type = $contract->data->contract_type;
            $this->min_contract = $contract->data->min_contract;
            $this->quantity = $contract->data->min_contract;
            $this->getTotalAmount();
            $this->getDate();
        }else {
            return;
        }
    }

    public function getSubPackages($id)
    {
        if ($id == null || $id == '-1') {
            $this->resetSubPackage();
            return;
        }

        $package = Package::findOrFail($id);
        $payload = json_decode($package->payload);

        foreach ($payload as $key => $value) {
            $result = [];
            if ($value->type == 'table') {
                $data = $value->data->table;
                foreach ($data as $key => $value) {
                    $table = (array) $value->data->table;
                    $toArray = (array) $table[app()->getLocale()];
                    $text = '';
                    foreach ($toArray as $subKey => $subValue) {
                        $text .= ' | ';
                        $text .=  $subKey;
                        $text .= ' : ';
                        $text .=  $subValue;
                        $text .= ' | ';
                    }
                    $result[] = [
                        'id' => $key,
                        'text' => $text,
                        'type' => 'table',
                        'selected' => $key == $this->sub_package_key ? true : false
                    ];
                }

            }elseif ($value->type == 'list') {
                $data = $value->data->list;

                foreach ($data as $key => $list) {
                    $textKey = (array) $list->key;
                    $teextValue = (array) $list->value;

                    $text = '<td>'.$textKey[app()->getLocale()] . ' : ' . $teextValue[app()->getLocale()].'</td>';
                    $result[] = [
                        'id' => $key,
                        'text' => $text,
                        'type' => 'list',
                        'selected' => $key == $this->sub_package_key ? true : false
                    ];
                }
            }else {
                return;
            }
            $this->dispatch('getSubPackages', $result);
        }
    }

    public function getSubPackageDetail($type)
    {

        if ($this->sub_package_key == null || $this->sub_package_key == '-1') {
            $this->resetSubPackage();
            return;
        }else {
            $package = Package::find($this->package_id);
            $payload = json_decode($package->payload);
            if ($type == 'table') {
                $data = collect($payload)->where('type', $type)->first();
                $this->price = $data->data->table[$this->sub_package_key]->data->package_price;
                $this->min_contract = $data->data->table[$this->sub_package_key]->data->min_contract;
                $this->quantity = $data->data->table[$this->sub_package_key]->data->min_contract;
                $this->contract_type = $data->data->table[$this->sub_package_key]->data->contract_type;
            }elseif ($type == 'list') {
                $data = collect($payload)->where('type', $type)->first();
                $this->price = $data->data->list[$this->sub_package_key]->package_price;
                $this->min_contract = $data->data->list[$this->sub_package_key]->min_contract;
                $this->quantity = $data->data->list[$this->sub_package_key]->min_contract;
                $this->contract_type = $data->data->list[$this->sub_package_key]->contract_type;
            }else {
                return;
            }
        }



        $this->getDate();
        $this->getTotalAmount();
    }

    public function getTotalAmount()
    {
        $this->total_amount = $this->price * $this->quantity;
    }

    public function getDate()
    {
        switch ($this->contract_type) {
            case 'daily':
                $this->started_at = Carbon::now()->format('Y-m-d');
                $this->ended_at = Carbon::now()->addDays($this->quantity)->format('Y-m-d');
                break;
            case 'monthly':
                $this->started_at = Carbon::now()->format('Y-m-d');
                $this->ended_at = Carbon::now()->addMonths($this->quantity)->format('Y-m-d');
                break;
            case 'yearly':
                $this->started_at = Carbon::now()->format('Y-m-d');
                $this->ended_at = Carbon::now()->addYears($this->quantity)->format('Y-m-d');
                break;
            case 'periode':
                $this->started_at = NULL;
                $this->ended_at = NULL;
                break;
            case 'once':
                $this->started_at = NULL;
                $this->ended_at = NULL;
                break;
            default:
                $this->started_at = NULL;
                $this->ended_at = NULL;
                break;
        }

        $data = [
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at
        ];

        if ($this->started_at != null && $this->ended_at != null) {
            $this->dispatch('setDate', $data);
        }
    }

    public function resetSubPackage()
    {
        $this->sub_package_key = null;
        $this->price = null;
        $this->min_contract = null;
        $this->quantity = null;
        $this->contract_type = null;
        $this->total_amount = null;
        $this->started_at = null;
        $this->ended_at = null;
        $this->note = null;
        $this->dispatch('clearDate');
    }

    public function submit()
    {
        DB::beginTransaction();
        try {
            $this->record->update([
                'started_at' => Carbon::createFromFormat('d/m/Y', $this->started_at)->format('Y-m-d'),
                'ended_at' => Carbon::createFromFormat('d/m/Y', $this->ended_at)->format('Y-m-d'),
                'note' => $this->note
            ]);

            // $order = Order::create([
            //     'user_id' => $this->user_id,
            //     'order_number' => uniqid(),
            //     'total_amount' =>  $this->total_amount,
            // ]);

            // $orderItem = $order->orderItems()->create([
            //     'package_id' => $this->package_id,
            //     'payload' => json_encode([
            //         'package_id' => $this->package_id,
            //         'type' => $this->sub_package_type ?? null,
            //         'sub_package_key' => $this->sub_package_key ?? null,
            //     ]),
            //     'contract_type' => $this->contract_type,
            //     'quantity' => $this->quantity,
            //     'price' => $this->price,
            // ]);

            // $this->createSubscription($orderItem);
        }catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            throw new GeneralException(__('There was a problem creating this order & subscription. Please try again.'));
        }
        DB::commit();
        return redirect()->route('admin.subscription.index')->with('flash_success', __('The subscription was successfully updated.'));
    }

    public function createSubscription($item)
    {
            $data = [
                'user_id' => $this->user_id,
                'order_item' => $item->id,
                'status' => 'paid',
                'subscription_number' => 'SUBS-' . strtoupper(uniqid()),
                'status' => 'active',
                'contract_type' => $item->contract_type,
                'started_at' => Carbon::createFromFormat('d/m/Y', $this->started_at)->format('Y-m-d'),
                'ended_at' => Carbon::createFromFormat('d/m/Y', $this->ended_at)->format('Y-m-d'),
                'note' => $this->note
            ];

            Subscription::create($data);
    }

    public function render()
    {
        return view('livewire.backend.subscription-edit');
    }
}
