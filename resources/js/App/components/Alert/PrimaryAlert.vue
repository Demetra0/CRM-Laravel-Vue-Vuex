<template>
    <b-alert
        show
        variant="danger"
        class="message-registered"
    >
        <span class="message-registered__text">{{ message }}</span>
    </b-alert>
</template>

<script>
export default {
    name: "PrimaryAlert",
    props: {
        message: {
            type: String,
            default: "Hello!"
        }
    }
}
</script>

<style lang="scss">
$mainColor: #007AFF;
.message-registered {
    background: #E6F2FF;
    border-radius: 20px !important;
    border: none !important;
    vertical-align: middle;

    &__text {
        font-weight: 600;
        font-size: 15px;
        line-height: 20px;
        letter-spacing: -0.24px;
        color: $mainColor;
        padding: 20px 60px 20px 20px;
    }

    .close {
        margin-top: 3px;
        color: $mainColor;
        opacity: 1 !important;
        font-size: 17px !important;
    }

}
</style>
