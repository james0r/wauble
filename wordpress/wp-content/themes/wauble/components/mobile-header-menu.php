<?php

/**
 * This menu uses Navi as an alternative to NavWalker. 
 * See the link below for more info.
 *
 * @link https://github.com/log1x/navi
 */

$navigation = wauble()->menus->getNaviMenu('header_menu');
?>

<?php if ($navigation->isNotEmpty()) : ?>
<nav
  id="mobile-header-nav"
  class="tw-flex tw-items-center tw-h-full"
  x-id="['mobile-navigation']"
  x-trap.inert.noscroll="$store.global.isMobileMenuVisible"
>
  <button
    class="lg:tw-hidden tw-ml-auto tw-p-2"
    x-data
    @click="$store.global.toggleMobileMenu()"
    :aria-expanded="$store.global.isMobileMenuVisible ? 'true' : 'false'"
    aria-haspopup="menu"
    aria-label="Mobile Menu Toggle"
    :aria-controls="$id('mobile-navigation')"
  >
    <span class="tw-sr-only">
      Menu
    </span>
    <span
      x-cloak
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
    class="tw-absolute tw-top-full tw-inset-x-0"
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
      class="tw-w-full tw-text-center tw-bg-white tw-top-full tw-py-2"
      aria-label="Mobile Header Menu"
    >
      <?php foreach ($navigation->toArray() as $item) : ?>
      <?php
          $item->classes .= ' tw-py-1';
          ?>
      <?php if ($item->children) : ?>
      <li
        class="<?php echo trim($item->classes); ?><?php echo $item->active ? ' current-item' : ''; ?>"
        x-data="{ expanded: false }"
      >
        <div class="tw-relative tw-flex tw-items-center tw-mx-auto tw-max-w-max">
          <a
            href="<?php echo $item->url; ?>"
            class="hover:tw-text-blue-600"
          >
            <?php echo $item->label; ?>
          </a>
          <button
            class="tw-absolute tw-right-0 tw-translate-x-full"
            @click="expanded = !expanded"
            :aria-expanded="expanded ? 'true' : 'false'"
            aria-haspopup="menu"
            aria-label="Submenu Toggle"
            :class="expanded ? 'rotate-[180deg]' : 'tw-rotate-0'"
          >
            <?php Wauble()->render('icons/hi-chevron-down'); ?>
          </button>
        </div>

        <?php if ($item->children) : ?>
        <ul
          class="tw-flex tw-flex-col tw-items-center tw-my-2"
          x-show="expanded"
          x-collapse
          :aria-hidden="expanded ? 'false' : 'true'"
        >
          <?php foreach ($item->children as $child) : ?>
          <?php
                    $child->classes .= ' tw-py-1';
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
          class="hover:tw-text-blue-600"
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