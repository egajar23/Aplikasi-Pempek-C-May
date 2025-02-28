@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-hijau-toska focus:ring-hijau-toska rounded-md shadow-sm']) }}>
