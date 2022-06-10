<x-account-layout>
<div>
    @livewire('account.home', ['user'=>$user])
</div>

@push('styles')

@endpush
@push('scripts')
<!-- Charting library -->
{{--<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>--}}
{{--<!-- Chartisan -->--}}
{{--<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>--}}
{{--    <script src="{{ asset('vendor/clipboard.js/dist/clipboard.min.js') }}"></script>--}}
<!-- Your application script -->

<script>
    // const chart = new Chartisan({
    //   el: '#user_transaction_chart',
    //   url: "@chart('user_transaction_chart')",
    //   hooks: new ChartisanHooks()
    // .legend()
    // .colors()
    // // .datasets(['line', 'bar'])
    // .tooltip(),
    // });
    //
    // var clipboard = new ClipboardJS('#copy');
    //
    // clipboard.on('success', function(e) {
    //     console.info('Action:', e.action);
    //     console.info('Text:', e.text);
    //     console.info('Trigger:', e.trigger);
    //
    //     e.clearSelection();
    //     document.getElementById('copyMessage').innerText = 'Copied'
    // });
  </script>
@endpush

</x-account-layout>
