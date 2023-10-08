<?php

// Pluck arguments out into the template part scope.
extract($args);

$url = urlencode($url);
$title = urlencode($title);
$description = urlencode($description);
?>

<?php
/**
 * Sharing snippet generated by https://sharingbuttons.io/
 */
?>
<div class="fixed top-1/2 -translate-y-1/2 right-0 self-start hidden lg:block">
  <!-- Facebook -->
  <a
    class=""
    href="https://facebook.com/sharer/sharer.php?u=<?php echo $url; ?>"
    target="_blank"
    rel="noopener"
    aria-label="Share on Facebook"
  >
    <div
      aria-hidden="true"
      class="h-[54px] w-[54px] transition bg-[#3b5998] hover:bg-[#2d4373] flex items-center justify-center fill-white"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        class="h-[23px] w-auto"
      >
        <path
          d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"
        />
      </svg>
    </div>
  </a>

  <!-- Twitter -->
  <a
    class=""
    href="https://x.com/intent/tweet/?text=<?php echo $title; ?>&amp;url=<?php echo $url; ?>"
    target="_blank"
    rel="noopener"
    aria-label="Share on Twitter"
  >
    <div
      aria-hidden="true"
      class="h-[54px] w-[54px] transition bg-[#1E1E1E] hover:bg-[#4A4A4A] flex items-center justify-center"
    >
      <svg
        class="h-[20px] w-auto"
        viewBox="0 0 357 322"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M281.026 0.125H335.608L216.362 136.415L356.645 321.875H246.805L160.774 209.395L62.335 321.875H7.71998L135.265 176.098L0.690979 0.125H113.32L191.084 102.937L281.026 0.125ZM261.869 289.205H292.114L96.886 31.079H64.4305L261.869 289.205Z"
          fill="white"
        />
      </svg>
    </div>
  </a>

  <!-- LinkedIn -->
  <a
    class=""
    href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>&amp;title=<?php echo $title; ?>"
    target="_blank"
    rel="noopener"
    aria-label="Share on LinkedIn"
  >
    <div
      aria-hidden="true"
      class="h-[54px] w-[54px] transition bg-[#0077b5] hover:bg-[#046293] fill-white flex justify-center items-center"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        class="h-[19px] w-[19px]"
      >
        <path
          d="M6.5 21.5h-5v-13h5v13zM4 6.5C2.5 6.5 1.5 5.3 1.5 4s1-2.4 2.5-2.4c1.6 0 2.5 1 2.6 2.5 0 1.4-1 2.5-2.6 2.5zm11.5 6c-1 0-2 1-2 2v7h-5v-13h5V10s1.6-1.5 4-1.5c3 0 5 2.2 5 6.3v6.7h-5v-7c0-1-1-2-2-2z"
        />
      </svg>
    </div>
  </a>

   <!-- E-Mail -->
   <a
    class=""
    href="mailto:?subject=<?php echo $title; ?>&amp;body=<?php echo $url; ?>"
    target="_self"
    rel="noopener"
    aria-label=""
  >
    <div
      aria-hidden="true"
      class="h-[54px] w-[54px] transition bg-[#777] hover:bg-[#5e5e5e] fill-white flex justify-center items-center"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        class="h-auto w-[20px]"
      >
        <path
          d="M22 4H2C.9 4 0 4.9 0 6v12c0 1.1.9 2 2 2h20c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM7.25 14.43l-3.5 2c-.08.05-.17.07-.25.07-.17 0-.34-.1-.43-.25-.14-.24-.06-.55.18-.68l3.5-2c.24-.14.55-.06.68.18.14.24.06.55-.18.68zm4.75.07c-.1 0-.2-.03-.27-.08l-8.5-5.5c-.23-.15-.3-.46-.15-.7.15-.22.46-.3.7-.14L12 13.4l8.23-5.32c.23-.15.54-.08.7.15.14.23.07.54-.16.7l-8.5 5.5c-.08.04-.17.07-.27.07zm8.93 1.75c-.1.16-.26.25-.43.25-.08 0-.17-.02-.25-.07l-3.5-2c-.24-.13-.32-.44-.18-.68s.44-.32.68-.18l3.5 2c.24.13.32.44.18.68z"
        />
      </svg>
    </div>
  </a>

  <!-- Threads -->
  <!-- <a
    class=""
    href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>&amp;title=<?php echo $title; ?>&amp;summary=<?php echo $description; ?>&amp;source=<?php echo $url; ?>"
    target="_blank"
    rel="noopener"
    aria-label="Share on Threads"
  >
    <div
      aria-hidden="true"
      class="h-[54px] w-[54px] bg-black hover:bg-black/75 transition fill-white flex justify-center items-center"
    >
      <svg
        aria-label="Threads"
        viewBox="0 0 192 192"
        xmlns="http://www.w3.org/2000/svg"
        class="h-[25px] w-auto"
      >
        <path
          class=""
          d="M141.537 88.9883C140.71 88.5919 139.87 88.2104 139.019 87.8451C137.537 60.5382 122.616 44.905 97.5619 44.745C97.4484 44.7443 97.3355 44.7443 97.222 44.7443C82.2364 44.7443 69.7731 51.1409 62.102 62.7807L75.881 72.2328C81.6116 63.5383 90.6052 61.6848 97.2286 61.6848C97.3051 61.6848 97.3819 61.6848 97.4576 61.6855C105.707 61.7381 111.932 64.1366 115.961 68.814C118.893 72.2193 120.854 76.925 121.825 82.8638C114.511 81.6207 106.601 81.2385 98.145 81.7233C74.3247 83.0954 59.0111 96.9879 60.0396 116.292C60.5615 126.084 65.4397 134.508 73.775 140.011C80.8224 144.663 89.899 146.938 99.3323 146.423C111.79 145.74 121.563 140.987 128.381 132.296C133.559 125.696 136.834 117.143 138.28 106.366C144.217 109.949 148.617 114.664 151.047 120.332C155.179 129.967 155.42 145.8 142.501 158.708C131.182 170.016 117.576 174.908 97.0135 175.059C74.2042 174.89 56.9538 167.575 45.7381 153.317C35.2355 139.966 29.8077 120.682 29.6052 96C29.8077 71.3178 35.2355 52.0336 45.7381 38.6827C56.9538 24.4249 74.2039 17.11 97.0132 16.9405C119.988 17.1113 137.539 24.4614 149.184 38.788C154.894 45.8136 159.199 54.6488 162.037 64.9503L178.184 60.6422C174.744 47.9622 169.331 37.0357 161.965 27.974C147.036 9.60668 125.202 0.195148 97.0695 0H96.9569C68.8816 0.19447 47.2921 9.6418 32.7883 28.0793C19.8819 44.4864 13.2244 67.3157 13.0007 95.9325L13 96L13.0007 96.0675C13.2244 124.684 19.8819 147.514 32.7883 163.921C47.2921 182.358 68.8816 191.806 96.9569 192H97.0695C122.03 191.827 139.624 185.292 154.118 170.811C173.081 151.866 172.51 128.119 166.26 113.541C161.776 103.087 153.227 94.5962 141.537 88.9883ZM98.4405 129.507C88.0005 130.095 77.1544 125.409 76.6196 115.372C76.2232 107.93 81.9158 99.626 99.0812 98.6368C101.047 98.5234 102.976 98.468 104.871 98.468C111.106 98.468 116.939 99.0737 122.242 100.233C120.264 124.935 108.662 128.946 98.4405 129.507Z"
        ></path>
      </svg>
    </div>
  </a> -->
</div>