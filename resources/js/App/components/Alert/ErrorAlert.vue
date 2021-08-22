<template>
    <b-alert
        show
        variant="danger"
        class="message-error"
    >
        <span class="message-error__text">{{message}}</span>
    </b-alert>
</template>

<script>
export default {
    name: "ErrorAlert",
    props: {
        message: {
            type: String,
            default: "Error"
        }
    }
}
</script>

<style lang="scss">
$mainColor: #FF3B30;
.message-error {
    background: #ffebea !important;
    border-radius: 20px !important;
    border: none !important;
    vertical-align: middle;

    &__text {
        font-weight: 600;
        font-size: 15px;
        line-height: 20px;
        letter-spacing: -0.24px;
        color: $mainColor !important;
        padding: 20px 60px 20px 20px;
    }

    .close {
        margin-top: 3px;
        color: $mainColor !important;
        opacity: 1 !important;
        font-size: 17px !important;
    }

}
</style>
