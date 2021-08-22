<template>

    <div class="form-content">
        <div class="container">
            <div v-if="errorAlert">
                <ErrorAlert
                    message="Incorrect code 2fa"
                />
            </div>

            <div class="col-12 col-lg-5 form-main">
                <Form2FA/>
            </div>
        </div>
    </div>
</template>

<script>
import ErrorAlert from "../components/Alert/ErrorAlert";
import Form2FA from "../components/Google2faForm/Form2FA";

export default {
    data: () => ({
        error: false,
    }),
    computed: {
      errorAlert(){
          return this.$store.getters.google2faError
      }
    },
    components: {
        Form2FA,
        ErrorAlert
    }
}
</script>

<style lang="scss">

.btn-secondary {
    background: #EFEFF4;
    border-radius: 20px;
    border-color: transparent;

    &:hover {
        background: #EFEFF4;
        border-color: transparent;
    }
}
</style>
