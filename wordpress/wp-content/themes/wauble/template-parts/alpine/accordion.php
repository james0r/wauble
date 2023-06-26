<!-- Include these scripts somewhere on the page: -->
<script
  defer
  src="https://unpkg.com/@alpinejs/ui@3.10.5-beta.8/dist/cdn.min.js"
></script>
<script
  defer
  src="https://unpkg.com/@alpinejs/focus@3.10.5/dist/cdn.min.js"
></script>
<script
  defer
  src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js"
></script>

<div
  x-data
  x-tabs
  class="mx-auto max-w-3xl"
>
  <div
    x-tabs:list
    class="-mb-px flex items-stretch"
  >
    <button
      x-tabs:tab
      type="button"
      :class="$tab.isSelected ? 'border-gray-200 bg-white' : 'border-transparent'"
      class="inline-flex rounded-t-md border-t border-l border-r px-5 py-2.5"
    >Tab 1</button>

    <button
      x-tabs:tab
      type="button"
      :class="$tab.isSelected ? 'border-gray-200 bg-white' : 'border-transparent'"
      class="inline-flex rounded-t-md border-t border-l border-r px-5 py-2.5"
    >Tab 2</button>
  </div>

  <div
    x-tabs:panels
    class="rounded-b-md border border-gray-200 bg-white"
  >
    <section
      x-tabs:panel
      class="p-8"
    >
      <h2 class="text-xl font-bold">Tab 1 Content</h2>
      <p class="mt-2 text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, quo sequi error
        quibusdam quas temporibus animi sapiente eligendi! Deleniti minima velit recusandae iure.</p>
      <button class="mt-5 rounded-md border border-gray-200 px-4 py-2 text-sm">Take Action</button>
    </section>

    <section
      x-tabs:panel
      class="p-8"
    >
      <h2 class="text-xl font-bold">Tab 2 Content</h2>
      <p class="mt-2 text-gray-500">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
        anim id est laborum.</p>
      <button class="mt-5 rounded-md border border-gray-200 px-4 py-2 text-sm">Take Action</button>
    </section>
  </div>
</div>