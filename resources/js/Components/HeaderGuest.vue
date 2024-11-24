<template>
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <img src="/wynahealth.png" class="p-1" width="200"> <h4 class="ml-2 my-auto font-weight-bold">Patient Monitoring</h4>
      <!-- <ul class="c-header-nav ml-auto mr-4">

        <li class="c-header-nav-item dropdown">
          <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="true" aria-expanded="false">
            <div class="c-avatar"><img class="c-avatar-img"
                :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user.name}&amp;background=4e73df&amp;color=ffffff&amp;size=100`">
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right pt-0 mb-0 pb-0">
            <button v-if="hasAnyPermission(['backup.create'])" class="dropdown-item" @click="backup_database">
              <i class="fa fa-database"></i>
              Export Database
            </button>
            <Link :href="`/apps/users/${$page.props.auth.user.id}`" class="dropdown-item" role="button">
                <i class="fa fa-user-circle"></i>
                My Profile
            </Link>
            <Link href="/logout" method="POST" as="button" class="dropdown-item" role="button" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
                Logout
            </Link>
          </div>
        </li>
      </ul> -->
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
        // response_data : '',
        user_id : ''
      }),

      methods: {

      }
    }
  </script>

  <style>

  </style>
