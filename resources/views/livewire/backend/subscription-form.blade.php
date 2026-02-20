<div id="subscription-form">
    <div class="form-group" wire:ignore>
        <label for="select-user" class="font-medium">User</label>
        <select id="select-user" class="form-control">
            <option value="-1" selected disabled>--- Select User ---</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group" wire:ignore>
        <label for="select-category" class="font-medium">Category</label>
        <select id="select-category" class="form-control">
            <option value="-1" selected disabled>--- Select Category ---</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group" wire:ignore>
        <label for="select-package" class="font-medium">Package</label>
        <select id="select-package" class="form-control" wire:loading.attr="disabled"></select>
    </div>

    <div id="sub-package" class="hidden form-group" wire:ignore>
        <label for="select-sub-package">Sub Package</label>
        <select id="select-sub-package" class="form-control" wire:loading.attr="disabled">
        </select>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="quantity" class="font-medium">Quantity</label>
                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="1" min="{{ $min_contract }}" wire:model.blur="quantity" wire:loading.attr="disabled">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="contract_type" class="font-medium">Contract Type</label>
                <select id="contract_type" class="form-control" wire:model.blur="contract_type" wire:loading.attr="disabled">
                    <option value="daily">Daily</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                    <option value="periode">Periode</option>
                    <option value="once">One Time</option>
                    <option value="package">Package</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="price" class="font-medium">Start Date</label>
                <div class="datepicker date input-group">
                    <input type="text" placeholder="Choose Date" class="form-control date-input" id="started_at">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="price" class="font-medium">End Date</label>
                <div class="datepicker date input-group">
                    <input type="text" placeholder="Choose Date" class="form-control date-input" id="ended_at">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="form-group">
        <label for="price" class="font-medium">Price</label>
        <input type="number" id="price" class="form-control" placeholder="Price" value="0" wire:model.blur="price" wire:loading.attr="disabled">
    </div>

    <div class="form-group">
        <label for="total-amount" class="font-medium">Total Amount</label>
        <input type="number" id="total-amount" class="form-control" placeholder="Total Amount" value="0" wire:model.blur="total_amount" readonly wire:loading.attr="disabled">
    </div>

    <div class="form-group">
        <label for="note">Notes:</label>
        <textarea wire:model="note" class="form-control" rows="5" id="note"></textarea>
    </div>

    <button wire:loading.attr="disabled" wire:click="submit" class="float-right btn btn-sm btn-primary" type="submit">@lang('Create Subscription')</button>
</div>

@push('after-scripts')
    <script>
        window.onload = function () {
            // User
            $('#select-user').select2();
            $('#select-user').on('select2:select', function (e) {
                let data = e.params.data;
                @this.set('user_id', data.id);
            });

            // Category
            let category = $('#select-category').select2();
            category.on('select2:select', function (e) {
                let data = e.params.data;
                @this.set('category_id', data.id);

                package.empty();
                package.prop('disabled', true);
                subPackage.empty();
                $('#sub-package').addClass('hidden');
                subPackage.prop('disabled', true);
            });

            // Package
            let package = $('#select-package').select2({
                data: [
                    {id: -1, text: '--- Please select a package ---', selected: '', search:'', hidden:true }
                ],
            });
            package.prop('disabled', true);
            document.addEventListener('getPackages', function (event) {
                let data = event.detail[0];
                package.empty();
                data.unshift({id: -1, text: '--- Please select a package ---', selected: 'selected', search:'', hidden:true });
                package.prop('disabled', false);
                package.select2({
                    data: data
                });
            });
            package.on('select2:select', function (e) {
                let data = e.params.data;
                @this.set('package_id', data.id);
                @this.set('sub_package_type', data.type);
                subPackage.empty();
                $('#sub-package').addClass('hidden');
            })

            // Sub Package
            let subPackage = $('#select-sub-package').select2();
            subPackage.prop('disabled', true);
            document.addEventListener('getSubPackages', function (event) {
                let data = event.detail[0];
                data.unshift({id: -1, text: '<td>--- Please select a sub package ---<td>', selected: 'selected', search:'', hidden:true });
                $('#sub-package').removeClass('hidden');
                subPackage.empty();
                subPackage.prop('disabled', false);
                subPackage.select2({
                    data: data,
                    templateResult: function (d) { return $(d.text); },
                    templateSelection: function (d) { return $(d.text); },
                });
            });

            subPackage.on('select2:select', function (e) {
                let data = e.params.data;
                @this.set('sub_package_key', data.id);
                @this.set('sub_package_type', data.type);
            });


            // Date
            let started_at = $('#started_at').datepicker({
                autoclose: true,
                format: "dd/mm/yyyy"
            });

            let ended_at = $('#ended_at').datepicker({
                autoclose: true,
                format: "dd/mm/yyyy"
            });

            document.addEventListener('setDate', function (event) {
                let data = event.detail[0];
                started_at.datepicker('update', new Date(data.started_at));
                ended_at.datepicker('update', new Date(data.ended_at));
            });

            document.addEventListener('clearDate', function (event) {
                let data = event.detail[0];
                started_at.datepicker('clearDates');
                ended_at.datepicker('clearDates');
            });

            started_at.on('changeDate', function (e) {
                if (started_at.val()){
                    @this.set('started_at', moment(started_at.val(), 'DD/MM/YYYY').format('YYYY-MM-DD'));
                }
            });

            ended_at.on('changeDate', function (e) {
                if (ended_at.val()) {
                    @this.set('ended_at', moment(ended_at.val(), 'DD/MM/YYYY').format('YYYY-MM-DD'));
                }
            });
        }
    </script>
@endpush
