<form
  role="search"
  method="get"
  id="searchform"
  class="searchform"
  action="<?php echo home_url( '/' ); ?>"
>
  <div class="tw-flex tw-gap-x-2">
    <label
      class="tw-sr-only"
      for="s"
    >Search for:</label>
    <input
      type="text"
      value="<?php echo get_search_query(); ?>"
      name="s"
      id="s"
      class="tw-border tw-border-gray-300 tw-rounded-md tw-px-4 tw-py-2 tw-w-full"
    >
    <input
      type="submit"
      id="searchsubmit"
      value="Search"
      class="tw-bg-blue-500 hover:tw-bg-blue-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-md tw-cursor-pointer"
    >
  </div>
</form>