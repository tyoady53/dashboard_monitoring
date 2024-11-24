<template>
    <Head>
        <title>Login Account - Patient Monitoring</title>
    </Head>
    <div class="col-md-6">
        <div class="fade-in">
            <!-- <div class="text-center mb-4">
                <a href="" class="text-dark text-decoration-none">
                    <img src="/images/Wynacom.png" width="70">
                    <h3 class="mt-2 font-weight-bold">Wynacom Information System</h3>
                </a>
            </div> -->
            <div class="card-group">
                <div class="card border-top-purple border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="text-start">
                            <h5>Sign In</h5>
                            <!-- <p class="text-muted">Sign In to your account</p> -->
                        </div>
                        <hr>
                        <br>
                        <div v-if="session.status" class="alert alert-success mt-2">
                            {{ session.status }}
                        </div>
                        <form @submit.prevent="submit">
                            <h6>USERNAME : </h6>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <input class="form-control" v-model="form.email" :class="{ 'is-invalid': errors.email }" type="text" placeholder="Email Address">
                            </div>
                            <div v-if="errors.email" class="alert alert-danger">
                                {{ errors.email }}
                            </div>

                            <h6>PASSWORD : </h6>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input class="form-control" v-model="form.password" :class="{ 'is-invalid': errors.password }" type="password" placeholder="Password">
                            </div>
                            <div v-if="errors.password" class="alert alert-danger">
                                {{ errors.password }}
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary shadow-sm rounded-sm px-4 w-100" type="submit">LOGIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //import layout
    import LayoutAuth from '../../Layouts/Auth.vue';

    //import reactive
    import { reactive,ref } from 'vue';

    //import inertia adapter
    import { Inertia } from '@inertiajs/inertia';

    //import Heade and useForm from Inertia
    import {
        Head,
        Link,
    } from '@inertiajs/inertia-vue3';

    export default {

        //layout
        layout: LayoutAuth,

        //register component
        components: {
            Head,
            Link
        },

        props: {
            errors: Object,
            session: Object
        },

        //define composition API
        setup() {

            //define form state
            const form = reactive({
                email: '',
                password: '',
            });

            const responses = ref({});

            //submit method
            const submit = () => {
                var UrlOrigin = window.location.origin;
                var pathname = window.location.pathname;
                // var cookieUrl = this.$route.query.redirecturl
                //send data to server
                Inertia.post('/login', {
                    //data
                    email: form.email,
                    password: form.password,
                }
                ,{onSuccess : (response) => {
                    responses.value = response.props.auth.user.id;
                    // console.log(window.location);
                    if(response.props.auth.user.id){
                        if(!window.location.includes('/apps/master/meeting/attendance')){
                            console.log(pathname,'/apps/master/meeting/attendance',window.location.host,window.location);
                            window.location.href = UrlOrigin+'/apps/dashboard';
                        }
                    }
                }}
                );
            }

            return {
                responses,
                form,
                submit,
            };

        }

    }
</script>

<style>

</style>
