<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded border border-gray-800 hover:border-red-500']) }}>
    {{ $slot }}
</button>
