<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\PackageCategory;
use App\Domains\Auth\Models\User;
use App\Models\Package;
use Illuminate\Support\Arr;

class SubscriptionForm extends Component
{
    public $users, $categories, $packages;
    public $user_id, $category_id, $package_id, $sub_package_key, $sub_package_type;
    public $price, $contract_type, $min_contract, $quantity, $total_amount;

    public function mount()
    {
        $this->users = User::users()->get();
        $this->categories = PackageCategory::with('packages')->Published()->get();
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
    }

    public function getPackages($id)
    {
        $this->packages = Package::where('category_id', $id)->get();

        $mapped = $this->packages->map(function ($package) {
            return [
                'id' => $package->id,
                'text' => $package->title,
                'type' => null
            ];
        });

        $this->dispatch('getPackages', $mapped);
    }

    public function getPackageDetail($id)
    {
        if ($id == null) {
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
        }else {
            return;
        }
    }

    public function getSubPackages($id)
    {
        if ($id == null) {
            return;
        }

        $package = Package::find($id);
        $payload = json_decode($package->payload);

        foreach ($payload as $key => $value) {
            if ($value->type == 'table') {
                $data = $value->data->table;
                $result = [];
                foreach ($data as $key => $value) {
                    $table = (array) $value->data->table;
                    $toArray = (array) $table[app()->getLocale()];
                    $text = '';
                    foreach ($toArray as $subKey => $subValue) {
                        $text .= '<td style="padding: 0 4px; font-weight: bold">|</td>';
                        $text .= '<td>' . $subKey . '</td>';
                        $text .= '<td style="padding: 0 4px">:</td>';
                        $text .= '<td>' . $subValue . '</td>';
                        $text .= '<td style="padding: 0 4px; font-weight: bold">|</td>';
                    }

                    $result[] = [
                        'id' => $key,
                        'text' => $text,
                        'type' => 'table'
                    ];
                }
                $this->dispatch('getSubPackages', $result);

            }elseif ($value->type == 'list') {
                $data = $value->data->list;
                $result = [];

                foreach ($data as $key => $list) {
                    $textKey = (array) $list->key;
                    $teextValue = (array) $list->value;

                    $text = '<td>'.$textKey[app()->getLocale()] . ' : ' . $teextValue[app()->getLocale()].'</td>';
                    $result[] = [
                        'id' => $key,
                        'text' => $text,
                        'type' => 'list'
                    ];
                }
                $this->dispatch('getSubPackages', $result);
            }else {
                return;
            }
        }
    }

    public function getSubPackageDetail($type)
    {
        $package = Package::find($this->package_id);
        $payload = json_decode($package->payload);

        if ($this->sub_package_key == null) {
            return;
        }else {
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




        $this->getTotalAmount();
    }

    public function getTotalAmount()
    {
        $this->total_amount = $this->price * $this->quantity;
    }

    public function resetSubPackage()
    {
        $this->sub_package_key = null;
        $this->price = null;
        $this->min_contract = null;
        $this->quantity = null;
        $this->contract_type = null;
        $this->total_amount = null;
    }

    public function render()
    {
        return view('livewire.backend.subscription-form');
    }
}
