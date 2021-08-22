<template>
    <div class="form-content">
        <div class="container">
            <!--    Спиннер    -->
            <div v-if="loading">
                <b-spinner
                    label="Loading..."
                    :variant ="'primary'"
                    :key ="'primary'"
                />
            </div>

            <div v-else class="col-12 col-lg-5 form-main">

                <PrimaryAlert
                    v-if="checkError"
                    :message="registeredUser"
                />

                <LoginForm/>

            </div>

        </div>
    </div>
</template>

<script>
import LoginForm from "../components/LoginForm/LoginForm";
import PrimaryAlert from "../components/Alert/PrimaryAlert";
export default {
    data() {
        return {
            loading: true, // показывать спиннер во время загрузки
        }
    },
    components: {
        LoginForm,
        PrimaryAlert,
    },
    mounted() {
        // Проверка токена. Если его нет или недействительный, тогда logout
        if (this.$store.state.token !== '') {
            axios.post('/api/auth/checkToken', {token: this.$store.state.token})
                .then(res => {
                    this.loading = false
                    if (res.data.success) {
                        this.$router.push('/users')
                    } else {
                        this.$store.commit('setToken', res.data.token)
                    }
                })
                .catch(err => {
                    this.loading = false
                    this.$store.commit('clearToken')
                    this.$store.commit('logout')
                })
        } else {
            this.loading = false
        }
    },
    computed: {
        checkError(){
            return this.$store.getters.registeredUser
        },
        registeredUser() {
            return `Hello, ${this.$store.getters.registeredUser.name}! You can now login`
        }
    },
}
</script>

<style lang="scss">
</style>
