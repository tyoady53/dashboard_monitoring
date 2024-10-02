<template>
    <div class="c-app">
      <div class="c-wrapper c-fixed-components">
      <!-- <div class="c-wrapper"> -->

        <!-- header -->
        <HeaderGuest />
        <!-- end header -->

        <div class="c-body">

            <!-- content -->
            <slot />

            <!-- end content -->
        </div>
        <footer class="c-footer">
            <div>&copy; {{ new Date().getFullYear() }} - PT. WYNACOM UNITAMA SEJAHTERA</div>
        </footer>
      </div>
    </div>
  </template>

  <script>

    import HeaderGuest from '../Components/HeaderGuest.vue'

    export default {

      //register components
      components: {
        HeaderGuest
      },

    }
  </script>

  <style>
  </style>
