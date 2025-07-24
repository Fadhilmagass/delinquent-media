@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 focus:border-indigo-500 dark:focus:border-sky-500 focus:ring-indigo-500 dark:focus:ring-sky-500 rounded-md shadow-sm transition-colors duration-300']) }}>
