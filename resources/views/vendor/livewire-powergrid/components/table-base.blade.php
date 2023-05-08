@props([
    'theme' => null
])
<div>
    <table class="table power-grid-table table-bordered table-hover {{ !Request::routeIs('kendaraan.index') ? 'table-striped' : ''  }} table-checkable table-highlight-head mb-2"
           style="{{$theme->tableStyle}}">
        <thead class="{{$theme->theadClass}}"
               style="{{$theme->theadStyle}}">
                {{ $header }}
        </thead>
        <tbody class="{{$theme->tbodyClass}}"
               style="{{$theme->tbodyStyle}}">
                {{ $rows }}
        </tbody>
    </table>
</div>
