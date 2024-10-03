<template>
    <div class="c-app">
      <div class="c-wrapper c-fixed-components">

        <!-- header -->
        <Header />
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

    import Header from '../Components/Header.vue'

    export default {

      //register components
      components: {
        Header
      },

    }
  </script>

  <style>
  </style>
