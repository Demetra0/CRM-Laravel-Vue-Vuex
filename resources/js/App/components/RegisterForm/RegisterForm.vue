<template>
    <b-form @submit.prevent="register" v-if="show">

        <ErrorAlert
            v-if="regError"
            :message="regError"
        />

        <b-form-group id="input-group-1" label="Your Name" label-for="input-1">
            <b-form-input
                id="input-1"
                v-model="formRegister.name"
                placeholder="Enter name"
                required
            ></b-form-input>
            <span v-if="errors.has('name')" class="invalid-feedback" role="alert">{{ errors.first('name') }}</span>
        </b-form-group>

        <b-form-group
            id="input-group-2"
            label="Email address"
            label-for="input-2"
        >
            <b-form-input
                id="input-2"
                v-model="formRegister.email"
                type="email"
                placeholder="Enter email"
                required
            ></b-form-input>
            <span v-if="errors.has('email')" class="invalid-feedback" role="alert">{{ errors.first('email') }}</span>
        </b-form-group>

        <b-form-group
            id="input-group-3"
            label="Password"
            label-for="input-3"
        >
            <b-form-input
                id="input-3"
                v-model="formRegister.password"
                type="password"
                placeholder="Enter password"
                required
            ></b-form-input>
            <span v-if="errors.has('password')" class="invalid-feedback" role="alert">{{ errors.first('password') }}</span>
        </b-form-group>

        <div class="btn-center">
            <ButtonAccept text="Register"></ButtonAccept>
        </div>

    </b-form>
    <div v-else>
        <div class="container">
            <div class="row justify-content-center align-items-center h-70">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading font-weight-bold">Set up Google Authenticator</div>
                        <hr>

                        <div class="panel-body" style="text-align: center;">
                            <p>Set up your two factor authentication by scanning the barcode below with you Google
                                Authenticator app. Alternatively, you can use the code <strong>{{secret}}</strong> </p>
                            <div>
                                <div v-html="QR"></div>
                            </div>

                            <div>
                                <router-link to="/login" class="btn btn-accept btn-primary">Login</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {registerUser} from '../../helper/auth';
import ButtonAccept from "../Button/ButtonAccept";
import ErrorAlert from "../Alert/ErrorAlert";

export default {
    name: "RegisterForm",
    data: () => ({
        formRegister: {
            name: '',
            email: '',
            password: '',
        },
        show: true,
        QR: null,
        secret: null,
    }),
    components: {
        ButtonAccept,
        ErrorAlert,
    },
    methods: {
        register(){
            registerUser(this.$data.formRegister)
                .then(res => {
                    this.$store.commit("registerSuccess", res);
                    this.QR = res.QR
                    this.secret = res.g2fa
                    this.show = false
                })
                .catch(error => {
                    this.$store.commit("registerFailed", {error});
                })
        }
    },
    computed:{
        regError(){
            return this.$store.getters.regError
        }
    }
}
</script>

<style scoped>

</style>
