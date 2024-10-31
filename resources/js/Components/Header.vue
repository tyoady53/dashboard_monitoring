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
            <Link :href="`/user/my_profile`" class="dropdown-item" role="button">
                <i class="fa fa-user-circle"></i>
                My Profile
            </Link>
            <Link v-if="permissions.includes('users.index')" href="/user" class="dropdown-item" role="button">
                <i class="fa fa-user"></i>
                Users
            </Link>
            <Link v-if="permissions.includes('customer.index')" href="/customer" class="dropdown-item" role="button">
                <i class="fa fa-plus"></i>
                Customer/Branch
            </Link>
            <Link href="#" data-bs-toggle="modal" data-bs-target="#intervalModal" class="dropdown-item" role="button" v-if="routeName == '/home'">
                <i class="fa fa-clock"></i> Refresh Interval
            </Link>
            <Link v-if="permissions.includes('roles.index')" href="/role" class="dropdown-item" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-check"
                    viewBox="0 0 16 16">
                    <path
                        d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                    <path
                        d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                </svg>
                Roles
            </Link>
            <Link v-if="permissions.includes('permissions.index')" href="/permission" class="dropdown-item" role="button">
                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor">
                    <title/><g data-name="24-Spreading" id="_24-Spreading"><circle cx="32" cy="21" r="4" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <path d="M32,27a5,5,0,0,0-5,5v5a2,2,0,0,0,2,2v6a2,2,0,0,0,2,2h2a2,2,0,0,0,2-2V39a2,2,0,0,0,2-2V32A5,5,0,0,0,32,27Z" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <circle cx="58" cy="40" r="3" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <path d="M58,43a5,5,0,0,0-5,5v5a2,2,0,0,0,2,2v6a2,2,0,0,0,2,2h2a2,2,0,0,0,2-2V55a2,2,0,0,0,2-2V48A5,5,0,0,0,58,43Z" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <circle cx="58" cy="4" r="3" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <path d="M58,7a5,5,0,0,0-5,5v5a2,2,0,0,0,2,2v6a2,2,0,0,0,2,2h2a2,2,0,0,0,2-2V19a2,2,0,0,0,2-2V12A5,5,0,0,0,58,7Z" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <circle cx="6" cy="40" r="3" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <path d="M6,43a5,5,0,0,0-5,5v5a2,2,0,0,0,2,2v6a2,2,0,0,0,2,2H7a2,2,0,0,0,2-2V55a2,2,0,0,0,2-2V48A5,5,0,0,0,6,43Z" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <circle cx="6" cy="4" r="3" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <path d="M6,7a5,5,0,0,0-5,5v5a2,2,0,0,0,2,2v6a2,2,0,0,0,2,2H7a2,2,0,0,0,2-2V19a2,2,0,0,0,2-2V12A5,5,0,0,0,6,7Z" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <polyline points="18 13 14 13 24 27" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <polyline points="46 13 50 13 40 27" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <polyline points="46 55 50 55 40 41" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <polyline points="18 55 14 55 24 41" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px"/>
                        <line style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px" x1="50" x2="50" y1="51" y2="55"/>
                        <line style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px" x1="14" x2="14" y1="51" y2="55"/>
                        <line style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px" x1="50" x2="50" y1="13" y2="17"/>
                        <line style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:2px" x1="14" x2="14" y1="13" y2="17"/>
                    </g>
                </svg>
                 Permissions
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
        auth: Object,
      },

      data: () => ({
        route : '',
        user_id : '',
        routeName : '',
        fullScreen : true,
        permissions : [],
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
        this.get_permission();
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

        get_permission() {
            var UrlOrigin = window.location.origin;
            axios
                .get(UrlOrigin + `/user/get_permissions`)
                .then((response) => {
                    console.log(response.data.data)
                    this.permissions = response.data.data;
                })
                .catch((error) => Swal.fire({
                        title: "Error!",
                        text: "Fetch data failed.",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2000,
                    })
                );
            // console.log('key down '+event);
            return false;
        },
      }
    }
  </script>

  <style>

  </style>
