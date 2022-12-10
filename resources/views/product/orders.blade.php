@extends('layouts.frames.master')
@section('content')

@push('slot')
@if(isset($ProductList))
<div class="search-form-item">
    <label class="label" for="ServiceZoneID">{{ __('msg.PUB_NAME') }}</label>
    <select class="custom-select" id="" name="ProductID" onchange="submit()">
        <option value="">{{ __('msg.ALL') }}</option>
        @foreach ($ProductList as $Product)
            <option @if(request()->ProductID == $Product->ProductID ) selected @endif
            value="{{ $Product->ProductID }}">{{ $Product->ProductName }}</option>
        @endforeach
    </select>
</div> <!-- /.search-form-item -->
@endif
<div class="search-form-item">
    <label class="label" for="CreateDate">{{ __('msg.AD') }}</label>
    <date-picker
        v-model="CreateDate"
        :input-id="'CreateDate'"
        :input-name="'CreateDate'"
        :input-class="'form-control'"
        :value-type="'format'"
        :icon-day="31"
        {{-- :clearable="false" --}}
        :lang="lang"
        :range="true"
        width="260"
        >
    </date-picker>
</div> <!-- /.search-form-item -->
@endpush

@include('layouts.sections.search')

<section class="section-table-section">
    <div class="table-responsive">
        <table class="table table-center table-font-size-90">
            <thead>
            <tr>
                @if( session('auth.AdminRoleID') === 2)
                    <th>
                    </th>
                @endif
                <th>
                    <div class="min-width">
                        <span>No</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.CITY') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.AREA') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.NAME_PERSON') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.TEL') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.C') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.CODE') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.PUB_NAME') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.ORDER_QU') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.AD') }}</span>
                    </div>
                </th>
                <th>
                    <div class="min-width">
                        <span>{{ __('msg.DT') }}</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
                {{--  {{ dd( count( $ProductOrderList) ) }}  --}}
                @if( count( $ProductOrderList) === 0)
                <tr>
                    <td
                    @if( session('auth.AdminRoleID') === 2)
                        colspan="12"
                    @else
                        colspan="11"
                    @endif
                    >{{ __('msg.NO_SEARCH_RESULTS') }}</td>
                </tr>
                @endif
                @foreach ($ProductOrderList as $ProductOrder)
                <tr ref="{{ $ProductOrder->ProductOrderID }}">
                    @if( session('auth.AdminRoleID') === 2)
                    <td>
                        <input name="ProductOrderID[]"
                            type="checkbox"
                            value="{{ $ProductOrder->ProductOrderID }}" @change="_change">
                    </td>
                    @endif
                    <td class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ listNumbering($loop->index, 30) }}
                    </td>
                    <td class="MetroName pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->MetroName }}
                    </td>
                    <td class="CircuitName pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->CircuitName }}
                    </td>
                    <td class="AdminName pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->AdminName }}
                    </td>
                    <td class="Mobile pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->Mobile }}
                    </td>
                    <td class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->ProductKind }}
                    </td>
                    <td class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->ProductAlias }}
                    </td>
                    <td class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->ProductName }}
                    </td>
                    <td class="pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->OrderCnt }}
                    </td>
                    <td class="CreateDate pointer"
                        onclick="location.href = '/{{request()->path()}}/{{ $ProductOrder->ProductOrderID }}'">
                        {{ $ProductOrder->CreateDate }}
                    </td>
                    <td class="pointer"
                        @click="tracks = '{{ $ProductOrder->InvoiceCode }}'">
                        {{ $ProductOrder->InvoiceCode }}
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
    <div class="btn-flex-area btn-flex-row justify-content-between mt-3">
        <div class="d-flex">
            <button type="button" class="btn btn-success"
                @if(!$ProductOrderList->count())
                    disabled
                @endif
                @click="_export">{{ __('msg.EXCEL_DOWN') }}</button>
            @if( session('auth.AdminRoleID') === 2)
            <button type="button" class="btn btn-info"
                :disabled="checkedRow.length === 0"
                @click="_showModal('modalInvoiceCode')">
                {{ __('msg.ENTER_IN_NUM') }}
            </button>
            @endif
        </div>
        @if(session('auth.CircuitID'))
            @include('layouts.sections.registrationButton', [
                'label' => __('msg.PUB_REQUEST'),
            ])
        @endif
    </div>
    {{ $ProductOrderList->appends( request()->all() )->links() }}

</section>

@endsection

@section('popup')
<modal-invoice-code v-if="showModal === 'modalInvoiceCode'"
    :array="checkedRow"
    @submit="_setInvoiceCode"
    @close="showModal = ''">
</modal-invoice-code>
<modal-delivery-tracking v-if="showModal === 'modalDeliveryTracking'"
    :tracks="tracks"
    @close="showModal = ''">
</modal-delivery-tracking>
@endsection

@section('script')
@include('product.modalInvoiceCode')
@include('product.modalDeliveryTracking')
<script>
    var app = new Vue({
        el:'#wrapper-body',
        mixins: [datepickerLang],
        data:{
            showModal: '',
            tracks: '',
            CreateDate: [
                '{{ request()->StartDate }}',
                '{{ request()->EndDate }}',
            ],
            checkedRow: [],
        },
        computed:{
            query: function () {
                var query = '?MetroID={{ request()->MetroID }}';
                    query += '&CircuitID={{ request()->CircuitID }}';
                    query += '&ProductID={{ request()->ProductID }}';
                    query += '&StartDate=' + this.CreateDate[0];
                    query += '&EndDate=' + this.CreateDate[1];
                return query;
            }
        },
        watch: {
            tracks: function () {
                if(this.tracks !== '');
                    this._showModal('modalDeliveryTracking');
            }
        },
        methods:{
            _showModal:function (modalName) {
                this.showModal = modalName;
            },
            _export:function () {
                location.href = '/{{ request()->path() }}/export' + this.query;
            },
            _change:function (e) {
                if(e.target.checked)
                    this.checkedRow.push(Number(e.target.value))
                else{
                    var idx = this.checkedRow.indexOf(Number(e.target.value))
                    if (idx > -1) this.checkedRow.splice(idx, 1)

                }
                this.checkedRow.sort(function(a, b) { // 내림차순
                    return b - a;
                });
            },
            _setInvoiceCode:function (InvoiceCode) {
                var formData = {
                    InvoiceCode: InvoiceCode,
                    ProductOrderID: this.checkedRow
                }
                axios.post('{{ request()->path() }}', formData)
                    .then(function (response) {
                        // console.log(response);
                        location.reload()
                    })
                    .catch(function (error) {
                        alert( __('msg.F') );
                        console.log(error);
                        console.log(error.response);
                    });
                // this.$refs.form.submit();
                // location.href = '/{{ request()->path() }}/export' + this.query;
            },
        }
    })
</script>
@endsection
