<template>
    <b-form @submit.prevent="authenticate">

        <div v-if="authError">
            <ErrorAlert
                :message="authError"
            />
        </div>

        <b-form-group
            id="input-group-1"
            label="Email"
            label-for="input-1"
        >
            <b-form-input
                id="input-1"
                v-model="formLogin.email"
                type="email"
                placeholder="Enter email"
                required
            ></b-form-input>
        </b-form-group>

        <b-form-group
            id="input-group-2"
            label="Password"
            label-for="input-2"
        >
            <b-form-input
                type="password"
                v-model="formLogin.password"
                id="text-password"
                placeholder="Enter password"
                aria-describedby="password-help-block"
            ></b-form-input>
        </b-form-group>

        <div class="btn-center">
            <ButtonAccept text="Login"></ButtonAccept>
        </div>

    </b-form>
</template>

<script>
import {login} from "../../helper/auth";
import ButtonAccept from "../Button/ButtonAccept";
import ErrorAlert from "../Alert/ErrorAlert";

export default {
    name: "LoginForm",
    data: () => ({
        formLogin: {
            email: '',
            password: '',
        },
    }),
    methods:{
        authenticate(){
            this.$store.dispatch('login');
            login(this.$data.formLogin)
                .then(res => {
                    this.$store.commit('setToken', res.access_token)
                    this.$store.commit("loginSuccess", res);
                    this.$router.push({path: '/2fa'});
                })
                .catch(error => {
                    this.$store.commit("loginFailed", {error});
                })
        }
    },
    components: {
        ButtonAccept,
        ErrorAlert,
    },
    computed: {
        authError() {
            return this.$store.getters.authError
        },
    },
}
</script>

<style scoped>

</style>
