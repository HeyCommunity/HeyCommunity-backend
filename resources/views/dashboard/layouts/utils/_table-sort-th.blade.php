@php
  $routeName = request()->route()->getName();
  $requestOrderBy = request('order-by') ?: $requestOrderBy;
  $requestOrderDirection = request('order-direction') ?: $requestOrderDirection;
@endphp

<th>
  @if ($requestOrderBy === $orderBy && $requestOrderDirection === 'ASC')
    <a href="{{ route($routeName, ['order-by' => $orderBy, 'order-direction' => 'DESC']) }}">
      {{ $name }} <i class="fe fe-arrow-up"></i>
    </a>
  @elseif ($requestOrderBy === $orderBy && $requestOrderDirection === 'DESC')
    <a href="{{ route($routeName, ['order-by' => $orderBy, 'order-direction' => 'ASC']) }}">
      {{ $name }} <i class="fe fe-arrow-down"></i>
    </a>
  @else
    <a href="{{ route($routeName, ['order-by' => $orderBy, 'order-direction' => 'DESC']) }}">
      {{ $name }} <i class="fe fe-repeat"></i>
    </a>
  @endif
</th>
