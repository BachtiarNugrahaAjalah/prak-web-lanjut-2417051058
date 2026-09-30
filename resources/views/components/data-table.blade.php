@php
    $tableId   = $tableId ?? 'data-table';
    $columns   = $columns ?? [];
    $fields    = $fields ?? [];
    $data      = $data ?? collect();
    $emptyText = $emptyText ?? 'Tidak ada data.';
@endphp

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-4">
        <input type="text" id="{{ $tableId }}-search" placeholder="Cari..."
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
            onkeyup="filterTable('{{ $tableId }}')">
    </div>

    <table class="w-full text-sm" id="{{ $tableId }}">
        <thead>
            <tr class="bg-gradient-to-r from-blue-500 to-purple-800 text-white">
                <th class="px-4 py-3 text-left">No</th>
                @foreach ($columns as $col)
                    <th class="px-4 py-3 text-left">{{ $col }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $row)
                <tr class="data-row border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    @foreach ($fields as $field)
                        <td class="px-4 py-3">{{ $row->$field ?? '-' }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + 1 }}" class="px-4 py-8 text-center text-gray-400">
                        {{ $emptyText }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
function filterTable(tableId) {
    const input = document.getElementById(tableId + '-search');
    const filter = input.value.toLowerCase();
    const table = document.getElementById(tableId);
    const rows = table.querySelectorAll('tbody tr.data-row');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
}
</script>