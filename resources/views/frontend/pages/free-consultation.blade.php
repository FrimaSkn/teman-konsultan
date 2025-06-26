@extends('frontend.layouts.app')

@section('title', __('Free Consultation'))

@section('content')
    <x-frontend.hero-section :image="asset('img/bg-hero-1.jpg')" />
    <section class="container py-20">
        <div class="text-3xl font-semibold text-center uppercase text-underline">free consultation</div>

        <div class="max-w-lg mx-auto mt-8">
            <x-forms.post :action="route('frontend.free-consultation.store')">
                <div class="grid grid-cols-3">
                    <div class="relative col-span-3 my-3">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 uppercase">nama lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="shadow-xs bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                            {{ $errors->has('name') ? 'border-red-500' : 'border-gray-600' }}"
                            placeholder="" required />
                        @error('name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-3">
                    <div class="relative col-span-3 my-3">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 uppercase">EMAIL</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="shadow-xs bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                            {{ $errors->has('email') ? 'border-red-500' : 'border-gray-600' }}"
                            placeholder=""
                            required />
                        @error('email')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-3">
                    <div class="relative col-span-3 my-3">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 uppercase">nomor whatsapp / hp</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                            class="shadow-xs bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                            {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-600' }}"
                            required />
                    </div>
                </div>

                <div class="grid grid-cols-3">
                    <div class="relative col-span-3 my-3">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 uppercase">PILIH AREA</label>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center mb-4">
                                <input id="Akuntansi" type="checkbox" name="area[]" value="Akuntansi" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                                <label for="Akuntansi" class="text-sm font-medium ms-2">Akuntansi</label>
                            </div>
                            <div class="flex items-center mb-4">
                                <input id="Perpajakan" type="checkbox" name="area[]" value="Perpajakan" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                                <label for="Perpajakan" class="text-sm font-medium ms-2">Perpajakan</label>
                            </div>
                            <div class="flex items-center mb-4">
                                <input id="Lainnya" type="checkbox" name="area" {{ old('area') ? old('area') == 'Lainnya' ? 'checked' : '' : '' }} value="Lainnya" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                                <label for="Lainnya" class="text-sm font-medium ms-2">Lainnya</label>
                            </div>
                        </div>
                        @error('area')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div id="input-area" class="hidden grid-cols-3">
                    <div class="relative col-span-3 my-3">
                        <label for="other-area" class="block mb-2 text-sm font-medium text-gray-900 uppercase">Lainnya</label>
                        <input type="text" id="other-area" name="other_area" value="{{ old('other_area') }}" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    </div>
                    @error('other_area')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-3">
                    <div class="relative col-span-3 my-3">
                        <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 uppercase">subject</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    @error('subject')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-3">
                    <div class="relative col-span-3 my-3">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 uppercase">CONSULTATION DETAIL</label>
                        <textarea id="message" name="message" rows="8" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >{{ old('message') }}</textarea>
                    </div>
                    @error('message')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                @if(config('boilerplate.access.captcha.registration'))
                    <div class="row">
                        <div class="col">
                            @captcha
                            <input type="hidden" name="captcha_status" value="true" />
                        </div><!--col-->
                    </div><!--row-->
                @endif

                <div class="float-right mt-3">
                    <button class="pl-8 pr-6 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center" type="submit">
                        <span>@lang('Submit')</span>
                        <i data-lucide="chevron-right"></i>
                    </button>
                </div>
            </x-forms.post>
        </div>
    </section>
@endsection

@push('after-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxOther = document.getElementById('Lainnya');
            const checkboxAkuntansi = document.getElementById('Akuntansi');
            const checkboxPerpajakan = document.getElementById('Perpajakan');
            checkboxOther.addEventListener('change', function() {
                if (this.checked) {
                    checkboxAkuntansi.checked = false;
                    checkboxPerpajakan.checked = false;
                    document.getElementById('input-area').style.display = 'grid';
                } else {
                    document.getElementById('input-area').style.display = 'none';
                    if (!checkboxAkuntansi.checked && !checkboxPerpajakan.checked) {
                        document.getElementById('other-area').value = '';
                    }
                }
            });

            checkboxAkuntansi.addEventListener('change', function() {
                if (this.checked) {
                    checkboxOther.checked = false;
                    document.getElementById('input-area').style.display = 'none';
                    document.getElementById('other-area').value = '';
                }
            });

            checkboxPerpajakan.addEventListener('change', function() {
                if (this.checked) {
                    checkboxOther.checked = false;
                    document.getElementById('input-area').style.display = 'none';
                    document.getElementById('other-area').value = '';
                }
            });
        });
    </script>
@endpush
