@if ($variation > 0)
<td class="positive" align="right">{{roNumber($variation)}}</td>
<td class="positive" align="middle"><i class="fa fa-caret-up"></i></td>
@elseif ($variation < 0)
<td class="negative" align="right">{{roNumber($variation)}}</td>
<td class="negative" align="middle"><i class="fa fa-caret-down"></i></td>
@else
<td align="right">{{$variation}}</td>
<td align="middle">-</td>
@endif