<form
  role="search"
  method="get"
  id="searchform"
  class="searchform"
  action="<?php echo get_home_url(); ?>"
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
      class="bg-primary-500 text-white px-4 py-2 rounded-md"
    >
  </div>
</form>