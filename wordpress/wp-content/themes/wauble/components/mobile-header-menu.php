<?php

/**
 * This menu uses Navi as an alternative to NavWalker. 
 * See the link below for more info.
 *
 * @link https://github.com/log1x/navi
 */

$navigation = wauble()->menus->getNaviMenu('header-menu');
?>

<?php if ($navigation->isNotEmpty()) : ?>
<nav
  id="mobile-header-nav"
  class="flex items-center h-full"
  x-id="['mobile-navigation']"
  x-trap.inert.noscroll="$store.global.isMobileMenuVisible"
>
  <button
    class="lg:hidden ml-auto p-2"
    x-data
    @click="$store.global.toggleMobileMenu()"
    :aria-expanded="$store.global.isMobileMenuVisible ? 'true' : 'false'"
    aria-haspopup="menu"
    aria-label="Mobile Menu Toggle"
    :aria-controls="$id('mobile-navigation')"
  >
    <span class="sr-only">
      Menu
    </span>
    <span
      x-show="!$store.global.isMobileMenuVisible"
      :aria-hidden="$store.global.isMobileMenuVisible ? 'true' : 'false'"
    >
      <?php Wauble()->render('icons/hi-bars-3'); ?>
    </span>
    <span
      x-cloak
      x-show="$store.global.isMobileMenuVisible"
      :aria-hidden="!$store.global.isMobileMenuVisible ? 'true' : 'false'"
    >
      <?php Wauble()->render('icons/hi-x-mark'); ?>
    </span>
  </button>
  <div
    :id="$id('mobile-navigation')"
    class="absolute top-full inset-x-0"
    x-data
    x-cloak
    @keyup.escape="$store.global.closeMobileMenu()"
    x-show="$store.global.isMobileMenuVisible"
    :aria-hidden="$store.global.isMobileMenuVisible ? 'false' : 'true'"
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
          $item_classes = [
            'py-1'
          ];

          if ($item->active) {
            $item_classes[] = 'current-item';
          }

          $item_classes = Wauble()->utils->tw($item_classes, $item->classes);
          ?>
      <?php if ($item->children) : ?>
      <li
        class="<?php echo $item_classes; ?>"
        x-data="{ expanded: false }"
      >
        <div class="relative flex items-center mx-auto max-w-max">
          <a
            href="<?php echo $item->url; ?>"
            class="hover:text-blue-600"
          >
            <?php echo $item->label; ?>
          </a>
          <button
            class="absolute right-0 translate-x-full"
            @click="expanded = !expanded"
            :aria-expanded="expanded ? 'true' : 'false'"
            aria-haspopup="menu"
            aria-label="Submenu Toggle"
            :class="expanded ? 'rotate-180' : 'rotate-0'"
          >
            <?php Wauble()->render('icons/hi-chevron-down'); ?>
          </button>
        </div>

        <ul
          class="flex flex-col items-center my-2"
          x-show="expanded"
          x-collapse
          :aria-hidden="expanded ? 'false' : 'true'"
        >
          <?php foreach ($item->children as $child) : ?>
          <?php
                  $child_classes = [
                    'py-1'
                  ];

                  if ($child->active) {
                    $child_classes[] = 'current-item';
                  }

                  $child_classes = Wauble()->utils->tw($child_classes, $child->classes);
                  ?>
          <li
            class="<?php echo $child_classes; ?>"
            :aria-hidden="expanded ? 'false' : 'true'"
          >
            <a href="<?php echo $child->url; ?>">
              <?php echo $child->label; ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </li>
      <?php else : ?>
      <li class="<?php echo $item_classes; ?>">
        <a
          href="<?php echo $item->url; ?>"
          class="hover:text-blue-600"
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