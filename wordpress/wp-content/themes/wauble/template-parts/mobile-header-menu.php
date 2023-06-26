<?php

/**
 * This menu uses Navi as an alternative to NavWalker. 
 * See the link below for more info.
 *
 * @link https://github.com/log1x/navi
 */

$navigation = wauble()->menus->get_navi_menu('header_menu');
?>

<?php if ($navigation->isNotEmpty()) : ?>
<nav
  id="mobile-header-nav"
  class="flex items-center h-full"
>
  <button
    class="md:hidden ml-auto p-2"
    x-data
    @click="$store.global.toggleMobileMenu()"
  >
    <span class="sr-only">
      Menu
    </span>
    <span
      x-cloak
      x-show="!$store.global.isMobileMenuVisible"
      aria-hidden="true"
    >
      <?php echo get_template_part('template-parts/icons/hi-bars-3'); ?>
    </span>
    <span
      x-cloak
      x-show="$store.global.isMobileMenuVisible"
      aria-hidden="true"
    >
      <?php echo get_template_part('template-parts/icons/hi-x-mark'); ?>
    </span>
  </button>
  <div
    class="absolute top-full inset-x-0"
    x-data
    x-cloak
    @keyup.escape="$store.global.closeMobileMenu()"
    x-show="$store.global.isMobileMenuVisible"
    @click.outside="$store.global.isMobileMenuVisible = false"
    x-collapse.duration.300ms
  >
    <ul
      id="mobile-header-nav-list"
      class="w-full text-center bg-white top-full py-2"
      aria-label="Mobile Header Menu"
    >
      <?php foreach ($navigation->toArray() as $item) : ?>
      <?php
          $item->classes .= ' py-1';
          ?>
      <?php if ($item->children) : ?>
      <li
        class="<?php echo trim($item->classes); ?><?php echo $item->active ? ' current-item' : ''; ?>"
        x-data="{ expanded: false }"
      >
        <div class="relative flex items-center mx-auto max-w-max">
          <a
            href="<?php echo $item->url; ?>"
            class="hover:text-primary-600"
          >
            <?php echo $item->label; ?>
          </a>
          <button
            class="absolute right-0 translate-x-full"
            @click="expanded = !expanded"
            :aria-expanded="expanded ? 'true' : 'false'"
            aria-haspopup="menu"
            aria-label="Submenu Toggle"
            :class="expanded ? 'rotate-[180deg]' : 'rotate-0'"
          >
            <?php echo get_template_part('template-parts/icons/hi-chevron-down'); ?>
          </button>
        </div>

        <?php if ($item->children) : ?>
        <ul
          class="flex flex-col items-center my-2"
          x-show="expanded"
          x-collapse
          :aria-hidden="expanded ? 'false' : 'true'"
        >
          <?php foreach ($item->children as $child) : ?>
          <?php
                    $child->classes .= ' py-1';
                    ?>
          <li
            class="<?php echo trim($child->classes); ?><?php echo $child->active ? ' current-item' : ''; ?>"
            :aria-hidden="expanded ? 'false' : 'true'"
          >
            <a href="<?php echo $child->url; ?>">
              <?php echo $child->label; ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </li>
      <?php else : ?>
      <li class="<?php echo trim($item->classes); ?><?php echo $item->active ? ' current-item' : ''; ?>">
        <a
          href="<?php echo $item->url; ?>"
          class="hover:text-primary-600"
        >
          <?php echo $item->label; ?>
        </a>
      </li>
      <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>
</nav>
<?php endif; ?>