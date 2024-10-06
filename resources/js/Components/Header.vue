<template>
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <Link href="/" role="button">
            <img src="/wynahealth.png" class="p-1" width="200">
        </Link>
      <ul class="c-header-nav ml-auto mr-4">

        <li class="c-header-nav-item dropdown">
          <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="true" aria-expanded="false">
            <div class="c-avatar"><img class="c-avatar-img"
                :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user.name}&amp;background=4e73df&amp;color=ffffff&amp;size=100`">
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right pt-0 mb-0 pb-0">
            <Link :href="`/user/${$page.props.auth.user.id}`" class="dropdown-item" role="button">
                <i class="fa fa-user-circle"></i>
                My Profile
            </Link>
            <Link v-if="$page.props.auth.user.id == 1" href="/user" class="dropdown-item" role="button">
                <i class="fa fa-user"></i>
                Users
            </Link>
            <Link v-if="$page.props.auth.user.id == 1" href="/customer" class="dropdown-item" role="button">
                <i class="fa fa-plus"></i>
                Customer/Branch
            </Link>
            <Link href="#" data-bs-toggle="modal" data-bs-target="#intervalModal" class="dropdown-item" role="button" v-if="routeName == '/home'">
                <i class="fa fa-clock"></i> Refresh Interval
            </Link>
            <!-- <Link href="#" data-bs-toggle="modal" data-bs-target="#intervalModal" class="dropdown-item" role="button">
                <i class="fa fa-clock"></i> Full Screen
            </Link> -->
            <Link href="/logout" method="POST" as="button" class="dropdown-item" role="button" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
                Logout
            </Link>
          </div>
        </li>
      </ul>
    </header>
  </template>

  <script>

    //import Link
    import { Link } from '@inertiajs/inertia-vue3';

    import { reactive } from 'vue';

    import { Inertia } from '@inertiajs/inertia';

    import axios from 'axios';

    import Swal from 'sweetalert2';

    export default {
      components: {
        Link
      },

      props: {
        auth: Object
      },

      data: () => ({
        route : '',
        user_id : '',
        routeName : '',
        fullScreen : true,
      }),

      watch:{
        // '$route': 'currentRoute'
        '$route'() {
            this.currentRoute(); // Call method to update current route
        },
      },

      mounted() {
        // // Initialize the current route when the component is mounted
        // this.currentRoute();

        // Listen to Inertia events
        this.setupInertiaListeners();
      },

      methods: {
        currentRoute() {
            this.routeName = window.location.pathname;
            console.log(window.location.pathname)
        },

        setupInertiaListeners() {
            Inertia.on('navigate', (event) => {
                // This will run every time Inertia navigates to a new page
                this.currentRoute();
            });
        },
      }
    }
  </script>

  <style>

  </style>
