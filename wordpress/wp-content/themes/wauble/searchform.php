<form
  role="search"
  method="get"
  id="searchform"
  class="searchform"
  action="<?php echo home_url( '/' ); ?>"
>
  <div class="flex gap-x-2">
    <label
      class="sr-only"
      for="s"
    >Search for:</label>
    <input
      type="text"
      value="<?php echo get_search_query(); ?>"
      name="s"
      id="s"
      class="border border-gray-300 rounded-md px-4 py-2 w-full"
    >
    <input
      type="submit"
      id="searchsubmit"
      value="Search"
      class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md cursor-pointer"
    >
  </div>
</form>