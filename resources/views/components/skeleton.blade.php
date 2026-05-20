@props(['type' => 'card'])

@if($type === 'card')
<div class="glass rounded-2xl overflow-hidden animate-pulse">
    <div class="w-full h-56 bg-gray-200"></div>
    <div class="p-6">
        <div class="h-4 bg-gray-200 rounded w-1/4 mb-3"></div>
        <div class="h-6 bg-gray-200 rounded w-3/4 mb-2"></div>
        <div class="h-4 bg-gray-200 rounded w-full mb-4"></div>
        <div class="flex justify-between">
            <div class="h-6 bg-gray-200 rounded w-1/3"></div>
            <div class="h-10 bg-gray-200 rounded w-20"></div>
        </div>
    </div>
</div>
@elseif($type === 'table-row')
<tr class="animate-pulse">
    <td class="px-6 py-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gray-200 rounded-lg"></div>
            <div class="h-4 bg-gray-200 rounded w-32"></div>
        </div>
    </td>
    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-24"></div></td>
    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-20"></div></td>
    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-16"></div></td>
    <td class="px-6 py-4"><div class="h-6 bg-gray-200 rounded w-20"></div></td>
    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-12"></div></td>
</tr>
@elseif($type === 'stat')
<div class="bg-white rounded-2xl p-6 shadow-sm animate-pulse">
    <div class="flex items-center justify-between mb-4">
        <div class="w-12 h-12 bg-gray-200 rounded-xl"></div>
        <div class="h-4 bg-gray-200 rounded w-12"></div>
    </div>
    <div class="h-4 bg-gray-200 rounded w-20 mb-2"></div>
    <div class="h-8 bg-gray-200 rounded w-24"></div>
</div>
@endif
