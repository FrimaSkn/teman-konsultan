@props([
    'paket' => null,
    'key' => null,
    'type' => 'slider',
    'minContract' => 1,
    'contractType' => null,
    'packagePrice' => 0
])
<form action="{{ route('frontend.cart.store') }}" method="POST">
    @csrf
    <input type="text" name="package_id" value="{{ $paket['id'] }}" hidden  />
    <input type="text" name="slug" value="{{ $paket['slug'] }}" hidden  />
    <input type="text" name="package_price" value="{{ $packagePrice }}" hidden  />
    <input type="text" name="type" value="{{ $type }}" hidden  />
    <input type="text" name="sub_package_key" value="{{ $key }}" hidden  />
    <input type="text" name="min_contract" value="{{ $minContract }}" hidden  />
    <input type="text" name="contract_type" value="{{ $contractType }}" hidden  />
    <button type="submit" class="pl-4 pr-2 pt-1 pb-1.5 w-56 h-12 uppercase bg-secondary rounded-xl hover:bg-opacity-90 text-primary font-medium text-nowrap inline-flex items-center justify-center">
        <span>@lang('Take Package')</span>
        <i data-lucide="chevron-right" class="size-4"></i>
    </button>
</form>
