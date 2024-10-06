<template>
    <Head>
        <title>Edit Employee - Master Form</title>
    </Head>
    <div class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-user"></i> EDIT EMPLOYEE</span>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="submit">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="fw-bold">Full Name</label>
                                                <input class="form-control" v-model="form.name" :class="{ 'is-invalid': errors.name }" type="text" placeholder="Full Name" readonly>
                                            </div>
                                            <div v-if="errors.name" class="alert alert-danger">
                                            {{ errors.name }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="fw-bold">Email</label>
                                                <input class="form-control" v-model="form.email" :class="{ 'is-invalid': errors.email }" type="email" placeholder="Email" readonly>
                                            </div>
                                            <div v-if="errors.email" class="alert alert-danger">
                                            {{ errors.email }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="fw-bold">Divisi</label>
                                                <select class="form-control" v-model="form.division" disabled>
                                                    <option disabled>Select One</option>
                                                    <option v-for="division in divisions" :key="division" :value="division.id" name="division">{{ division.name }}</option>
                                                </select>
                                                <!-- <input class="form-control" v-model="form.division" :class="{ 'is-invalid': errors.division }" type="email" placeholder="Email" readonly> -->
                                            </div>
                                            <div v-if="errors.division" class="alert alert-danger">
                                            {{ errors.division }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="fw-bold">KTP</label>
                                                <input class="form-control" v-model="form.id_number" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="KTP" maxlength="16">
                                                <!-- <input class="form-control" v-model="form.id_number" type="text"  pattern="[0-9]+" placeholder="KTP" maxlength="16"> -->
                                            </div>
                                            <div v-if="errors.id_number" class="alert alert-danger">
                                                {{ errors.id_number }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="fw-bold">Phone</label>
                                                <input class="form-control" v-model="form.phone" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="KTP" maxlength="15">
                                                <!-- <input class="form-control" v-model="form.phone" type="text"  pattern="[0-9]+" placeholder="KTP" maxlength="15"> -->
                                            </div>
                                            <div v-if="errors.phone" class="alert alert-danger">
                                                {{ errors.phone }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="fw-bold">Gender</label>
                                                <select class="form-control" v-model="form.gender">
                                                    <option disabled>Select One</option>
                                                    <option value="M" name="gender">Male</option>
                                                    <option value="F" name="gender">Female</option>
                                                </select>
                                                <!-- <input class="form-control" v-model="form.gender" type="text" pattern="\d*" placeholder="KTP" maxlength="10"> -->
                                            </div>
                                            <div v-if="errors.gender" class="alert alert-danger">
                                                {{ errors.gender }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="fw-bold">Tempat Lahir</label>
                                                <input class="form-control" v-model="form.pob" type="text" placeholder="Tempat Lahir">
                                                <!-- <input class="form-control" v-model="form.id_number" type="text"  pattern="[0-9]+" placeholder="KTP" maxlength="16"> -->
                                            </div>
                                            <div v-if="errors.id_number" class="alert alert-danger">
                                                {{ errors.id_number }}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="fw-bold">Tanggal Lahir</label>
                                                <input class="form-control" v-model="form.dob" type="date" placeholder="Tanggal Lahir">
                                                <!-- <input class="form-control" v-model="form.phone" type="text"  pattern="[0-9]+" placeholder="KTP" maxlength="15"> -->
                                            </div>
                                            <div v-if="errors.phone" class="alert alert-danger">
                                                {{ errors.phone }}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="fw-bold">Tanggal Bergabung</label>
                                                <input class="form-control" v-model="form.join_date" type="date" placeholder="Tanggal bergabung">
                                                <!-- <input class="form-control" v-model="form.gender" type="text" pattern="\d*" placeholder="KTP" maxlength="10"> -->
                                            </div>
                                            <div v-if="errors.join_date" class="alert alert-danger">
                                                {{ errors.gender }}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="fw-bold">Tanggal Resign</label>
                                                <input class="form-control" v-model="form.resign_date" type="date" placeholder="Tanggal Resign">
                                                <!-- <input class="form-control" v-model="form.gender" type="text" pattern="\d*" placeholder="KTP" maxlength="10"> -->
                                            </div>
                                            <div v-if="errors.resign_date" class="alert alert-danger">
                                                {{ errors.gender }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="fw-bold">Status</label>
                                                <select class="form-control" v-model="form.status">
                                                    <option disabled>Select One</option>
                                                    <option value="Kontrak" name="status">Kontrak</option>
                                                    <option value="Tetap" name="status">Tetap</option>
                                                </select>
                                                <!-- <input class="form-control" v-model="form.status" type="text" pattern="\d*" placeholder="KTP" maxlength="10"> -->
                                            </div>
                                            <div v-if="errors.status" class="alert alert-danger">
                                                {{ errors.status }}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="fw-bold">Lokasi Kerja</label>
                                                <select class="form-control" v-model="form.location">
                                                    <option disabled>Select One</option>
                                                    <option v-for="location in locations" :key="location" :value="location.id" name="location">{{ location.location_name }}</option>
                                                </select>
                                                <!-- <input class="form-control" v-model="form.location" type="text" pattern="\d*" placeholder="KTP" maxlength="10"> -->
                                            </div>
                                            <div v-if="errors.location" class="alert alert-danger">
                                                {{ errors.location }}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="fw-bold">Jabatan</label>
                                                <select class="form-control" v-model="form.position">
                                                    <option disabled>Select One</option>
                                                    <option v-for="position in positions" :key="position" :value="position.id" name="location">{{ position.name }}</option>
                                                </select>
                                                <!-- <input class="form-control" v-model="form.position" type="text" pattern="\d*" placeholder="KTP" maxlength="10"> -->
                                            </div>
                                            <div v-if="errors.position" class="alert alert-danger">
                                                {{ errors.position }}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="fw-bold">Jam Masuk</label>
                                                <input class="form-control" v-model="form.absence_time" type="time" pattern="\d*" placeholder="KTP">
                                            </div>
                                            <div v-if="errors.absence_time" class="alert alert-danger">
                                                {{ errors.absence_time }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Alamat Sesuai KTP</label>
                                                <textarea class="form-control" v-model="form.id_address" type="text" pattern="\d*" placeholder="KTP"></textarea>
                                            </div>
                                            <div v-if="errors.id_address" class="alert alert-danger">
                                                {{ errors.id_nuid_addressmber }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">Domisili</label>
                                                <textarea class="form-control" v-model="form.dom" type="text" pattern="\d*" placeholder="KTP"></textarea>
                                            </div>
                                            <div v-if="errors.dom" class="alert alert-danger">
                                                {{ errors.dom }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button class="btn btn-primary shadow-sm rounded-sm" type="submit">UPDATE</button>
                                            <button class="btn btn-warning shadow-sm rouned-sm ms-3" type="reset">RESET</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import LayoutApp from '../../../Layouts/App.vue';

import { Head, Link } from '@inertiajs/inertia-vue3';

import { ref,reactive } from 'vue';

import { Inertia } from '@inertiajs/inertia';

import Swal from 'sweetalert2';

export default {

    layout: LayoutApp,

    components: {
        Head,
        Link
    },

    props: {
        errors: Object,
        user: Object,
        locations : Array,
        positions : Array,
        divisions : Array,
    },

    created: function(){
    },

    methods: {
    },

    data: (props) => ({
    }),

    setup(props) {
        const active = ref(0);
        const cuti_mendadak = ref(0);

        const form = reactive({
            name: props.user.name,
            email: props.user.email,
            phone: props.user.phone,
            gender: props.user.gender,
            dob: props.user.dob,
            pob: props.user.pob,
            join_date: props.user.join_date,
            status: props.user.employee[0]?.employee_status,
            location: props.user.employee[0]?.location.id,
            position: props.user.employee[0]?.position.id,
            absence_time: props.user.absence_time[0]?.absence_time,
            id_address: props.user.id_address,
            dom: props.user.dom,
            id_number: props.user.id_number,
            division: props.user.division.id,
            resign_date: props.user.resign_date,
        });

        if(props.user){
            active.value = reactive(
                props.user.is_active === 1
            );
        }

        if(props.user){
            cuti_mendadak.value = reactive(
                props.user.cuti_mendadak === 1
            );
        }

        const submit = () => {
            Inertia.put(`/apps/master/employees/${props.user.id}`, {
                name: form.name,
                email: form.email,
                phone: form.phone,
                gender: form.gender,
                status: form.status,
                location: form.location,
                position: form.position,
                absence_time: form.absence_time,
                id_address: form.id_address,
                dom: form.dom,
                id_number: form.id_number,
                division: form.division,
                dob: form.dob,
                pob: form.pob,
                join_date: form.join_date,
                resign_date: form.resign_date
            }, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'User updated successfully.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
            });
        }
        return {
            form,
            submit,
            active,
            cuti_mendadak
        };
    }
}

</script>


<style>
.switch {
  position: relative;
  display: inline-block;
  width: 30px;
  height: 17px;
}

.switch input {
  display: none;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

input:checked + .slider {
    background: rgb(137, 75, 157);
}

input:focus + .slider {
  box-shadow: 0 0 1px #101010;
}

input:checked + .slider:before {
  -webkit-transform: translateX(13px);
  -ms-transform: translateX(13px);
  transform: translateX(13px);
}

.slider.round {
  border-radius: 17px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
