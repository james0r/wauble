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
  id="header-nav"
  aria-label="Header Menu"
>
  <ul
    id="header-nav-list"
    class="tw-flex tw-tracking-wider"
  >
    <?php foreach ($navigation->toArray() as $item) : ?>
    <?php
        $item_classes = [
          'tw-px-[min(12px,_1vw)]',
          'tw-py-2.5',
          'first:tw-pl-0',
          'tw-group',
          'tw-relative',
        ];

        if ($item->active) {
          $item_classes[] = 'current-item';
        }

        $item_classes = Wauble()->utils->tw($item_classes, $item->classes);
        ?>
    <?php if ($item->children) : ?>
    <li
      class="<?php echo $item_classes; ?>"
      x-data="{ 
            expanded: false,
            closeSubmenuOnFocusOut(element, event) {
              if (!element.closest('ul').contains(event.relatedTarget)) {
                this.expanded = false
              }
            }
           }"
    >
      <div class=" tw-flex tw-items-center tw-relative tw-max-w-max tw-mx-auto tw-pr-6">
        <a
          href="<?php echo $item->url; ?>"
          class="hover:tw-text-blue-600"
        >
          <?php echo $item->label; ?>
        </a>
        <button
          class="tw-absolute tw-right-0"
          @click="expanded = !expanded"
          :aria-expanded="expanded ? 'true' : 'false'"
          aria-haspopup="menu"
          aria-label="Submenu Toggle"
          :class="expanded ? 'tw-rotate-[180deg]' : 'tw-rotate-0'"
        >
          <?php Wauble()->render('icons/hi-chevron-down'); ?>
        </button>
      </div>

      <ul
        class="tw-hidden group-hover:tw-block tw-absolute tw-top-full tw-bg-white"
        :class="expanded && '!tw-block'"
      >
        <?php foreach ($item->children as $child) : ?>
        <?php
                $clild_classes = [];

                if ($child->active) {
                  $child_classes[] = 'current-item';
                }

                $child_classes = Wauble()->utils->tw($child_classes, $child->classes);
                ?>

        <li class="<?php echo $child_classes; ?>">
          <a
            href="<?php echo $child->url; ?>"
            @focusout="closeSubmenuOnFocusOut($el, $event)"
          >
            <?php echo $child->label; ?>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </li>
    <?php else : ?>
    <?php

          ?>
    <li class="<?php echo Wauble()->utils->tw($item_classes, $item->classes); ?>">
      <a
        href="<?php echo $item->url; ?>"
        class="hover:tw-text-blue-600 tw-font-bold"
      >
        <?php echo $item->label; ?>
      </a>
    </li>
    <?php endif; ?>
    <?php endforeach; ?>
  </ul>
</nav>
<?php endif; ?>